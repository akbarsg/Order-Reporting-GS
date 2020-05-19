<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supply;
use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Cart;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supply::all();

        return view('supplies.index', compact(['supplies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $senders = Sender::all()->sortBy('name');
        $receivers = Receiver::all()->sortBy('name');

        return view('supplies.create', compact(['senders', 'receivers']));
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
            'date' => 'required|date',
            'sender_id' => 'nullable',
            'receiver_id' => 'nullable',
            'sender_name' => 'nullable|string',
            'receiver_name' => 'nullable|string',
            'PO' => 'required|numeric',
        ]);

        $supply = new Supply;
        $supply->date = $request->date;
        $supply->sender_id = $request->sender_id;
        if ($request->sender_id == "baru") {
            $sender = new Sender;
            $sender->name = $request->sender_name;
            $sender->save();
            $supply->sender_id = $sender->id;
        } else {
            $supply->sender_id = $request->sender_id;
        }

        if ($request->receiver_id == "baru") {
            $receiver = new Receiver;
            $receiver->name = $request->receiver_name;
            $receiver->save();
            $supply->receiver_id = $receiver->id;
        } else {
            $supply->receiver_id = $request->receiver_id;
        }
        $supply->PO = $request->PO;
        $supply->save();

        foreach ($request->size as $key => $value) {
            $cart = new Cart;
            $cart->supply_id = $supply->id;
            $cart->size = $request->size[$key];
            $cart->color = $request->color[$key];
            $cart->amount = $request->amount[$key];
            $cart->save();
        }

        return redirect()->route('supply.index')->with('success', 'Order baru telah disimpan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supply = Supply::findOrFail($id);
        $supply->delete();

        return redirect()->route('supply.index')->with('success', 'Stok dihapus');
    }
}
