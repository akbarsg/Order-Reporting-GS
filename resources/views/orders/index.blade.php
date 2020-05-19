@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Order</div>
          
          <div class="card-body" class="table-responsive">
              <a href="{{ route('order.create') }}" class="btn btn-success pull-right">Order Baru</a>
              <br>
              <br>
            <table class="table" id="table-order">
                <thead>
                    <th>Tanggal</th>
                    <th>No. Order</th>
                    <th>Pengirim</th>
                    <th>Pembeli</th>
                    <th>No. Pembeli</th>
                    <th>Domisili</th>
                    <th>Jumlah Produk</th>
                    <th>Ekspedisi</th>
                    <th>Estimasi</th>
                    <th>Total</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                {{ $order->order_date }}
                            </td>
                            <td>
                                {{ $order->order_no }}
                            </td>
                            <td>
                                {{ $order->store->name }}
                            </td>
                            <td>
                                {{ $order->customer->name }}
                            </td>
                            <td>
                                {{ $order->customer->phone }}
                            </td>
                            <td>
                                {{ $order->customer->village->province->name }}
                            </td>
                            <td>
                                {{ $order->countProduct() }}
                            </td>
                            <td>
                                {{ $order->delivery->name }}
                            </td>
                            <td>
                                Rp{{ $order->estimation_cost }}
                            </td>
                            <td>
                                <b>Rp{{ $order->total_cost }}</b>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-order-{{ $order->id }}">
                                    Detail
                                  </button>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-order-{{ $order->id }}-delete">
                                      Hapus
                                    </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    
@foreach ($orders as $order)
<div class="modal fade" id="modal-order-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-order-{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" class="table-responsive">
          <table class="table">
              <tbody>
                <tr>
                    <td>
                        Tanggal dibuat
                    </td>
                    <td>
                        {{ $order->created_at }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Nomor Order
                    </td>
                    <td>
                        <b>{{ $order->order_no }}</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tanggal Order
                    </td>
                    <td>
                        {{ $order->order_date }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Pengirim
                    </td>
                    <td>
                        {{ $order->store->name }} ({{ $order->store->phone }})
                    </td>
                </tr>
                <tr>
                    <td>
                        Pembeli
                    </td>
                    <td>
                        {{ $order->customer->name }} ({{ $order->customer->phone }})
                    </td>
                </tr>
                <tr>
                    <td rowspan=2>
                        Alamat Pembeli
                    </td>
                    <td>
                        {{ $order->customer->address }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ $order->customer->village->name }}, {{ $order->customer->village->district->name }}, {{ $order->customer->village->regency->name }}, {{ $order->customer->village->province->name }} {{ $order->customer->postal_code }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Ekspedisi
                    </td>
                    <td>
                        {{ $order->delivery->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Biaya Service
                    </td>
                    <td>
                        Rp{{ $order->serviceCost() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Total Invoice
                    </td>
                    <td>
                        <b>Rp{{ $order->total_cost }}</b>
                    </td>
                </tr>
              </tbody>
          </table>

          <table class="table">
              <thead>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
              </thead>
              <tbody>
                  @foreach ($order->carts as $cart)
                    <tr>
                        <td>
                            {{ $cart->size }}
                        </td>
                        <td>
                            {{ $cart->color }}
                        </td>
                        <td>
                            {{ $cart->amount }}
                        </td>
                        <td>
                            <b>Rp{{ $cart->cost() }}</b>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
  
<div class="modal fade" id="modal-order-{{ $order->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="modal-order-{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Stok</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('order.destroy', $order->id) }}" method="POST">
            @csrf
            @method('DELETE')
        <div class="modal-body" class="table-responsive">
          Hapus order?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endforeach

</div>

@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#table-order').DataTable();
        } );
    </script>
@endsection