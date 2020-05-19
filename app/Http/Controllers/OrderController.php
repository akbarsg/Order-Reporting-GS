<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Store;
use App\Models\Cart;
use App\Models\Province;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();


        return view('orders.index', compact(['orders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        $customers = Customer::all()->sortBy('name');
        $deliveries = Delivery::all();
        $provinces = Province::all();

        return view('orders.create', compact(['stores', 'customers', 'deliveries', 'provinces']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_no' => 'required|unique:orders|max:255',
            'order_date' => 'required|date',
            'store_id' => 'required|exists:stores,id',
            'customer_id' => 'nullable',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string|max:15',
            'customer_address' => 'nullable|string',
            'province_id' => 'nullable|exists:indoregion_provinces,id',
            'regency_id' => 'nullable|exists:indoregion_regencies,id',
            'district_id' => 'nullable|exists:indoregion_districts,id',
            'village_id' => 'nullable|exists:indoregion_villages,id',
            'postal_code' => 'nullable|string|max:5',
            'delivery_id' => 'nullable',
            'delivery_name' => 'nullable|string',
            'estimation_cost' => 'nullable|numeric',
            'total_cost' => 'required|numeric',
        ]);

        $order = new Order;
        $order->order_no = $request->order_no;
        $order->order_date = $request->order_date;
        $order->store_id = $request->store_id;
        if ($request->customer_id == "baru") {
            $customer = new Customer;
            $customer->name = $request->customer_name;
            $customer->phone = $request->customer_phone;
            $customer->address = $request->customer_address;
            $customer->village_id = $request->village_id;
            $customer->postal_code = $request->postal_code;
            $customer->save();
            $order->customer_id = $customer->id;
        } else {
            $order->customer_id = $request->customer_id;
        }

        if ($request->delivery_id == "baru") {
            $delivery = new Delivery;
            $delivery->name = $request->delivery_name;
            $delivery->save();
            $order->delivery_id = $delivery->id;
        } else {
            $order->delivery_id = $request->delivery_id;
        }
        $order->estimation_cost = $request->estimation_cost;
        $order->total_cost = $request->total_cost;
        $order->save();

        foreach ($request->size as $key => $value) {
            $cart = new Cart;
            $cart->order_id = $order->id;
            $cart->size = $request->size[$key];
            $cart->color = $request->color[$key];
            $cart->amount = $request->amount[$key];
            $cart->save();
        }

        return redirect()->route('order.index')->with('success', 'Order baru telah disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order dihapus');
    }
}
