@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Stok</div>
          
          <div class="card-body" class="table-responsive">
              <a href="{{ route('supply.create') }}" class="btn btn-success pull-right">Stok Baru</a>
              <br>
              <br>
            <table class="table" id="table-supply">
                <thead>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>PO ke-</th>
                    <th>Jumlah Barang</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($supplies as $supply)
                        <tr>
                            <td>
                                {{ $supply->date }}
                            </td>
                            <td>
                                {{ $supply->sender->name }}
                            </td>
                            <td>
                                {{ $supply->receiver->name }}
                            </td>
                            <td>
                                {{ $supply->PO }}
                            </td>
                            <td>
                                {{ $supply->countProduct() }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-supply-{{ $supply->id }}">
                                    Detail
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-supply-{{ $supply->id }}-delete">
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

    
@foreach ($supplies as $supply)
<div class="modal fade" id="modal-supply-{{ $supply->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-supply-{{ $supply->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Stok</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" class="table-responsive">
          <table class="table">
              <tbody>
                <tr>
                    <td>
                        Tanggal
                    </td>
                    <td>
                        {{ $supply->date }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Pengirim
                    </td>
                    <td>
                        {{ $supply->sender->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Penerima
                    </td>
                    <td>
                        {{ $supply->receiver->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        PO ke-
                    </td>
                    <td>
                        {{ $supply->PO }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Jumlah Barang
                    </td>
                    <td>
                        {{ $supply->countProduct() }}
                    </td>
                </tr>
              </tbody>
          </table>

          <table class="table">
              <thead>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
              </thead>
              <tbody>
                  @foreach ($supply->carts as $cart)
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

  
<div class="modal fade" id="modal-supply-{{ $supply->id }}-delete" tabindex="-1" role="dialog" aria-labelledby="modal-supply-{{ $supply->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Stok</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('supply.destroy', $supply->id) }}" method="POST">
            @csrf
            @method('DELETE')
        <div class="modal-body" class="table-responsive">
          Hapus stok?
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
            $('#table-supply').DataTable();
        } );
    </script>
@endsection