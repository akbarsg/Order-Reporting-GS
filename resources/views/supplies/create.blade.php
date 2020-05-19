@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Kiriman Stok</div>
        
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          
          <form action="{{ route('supply.store') }}" method="POST">
            @csrf
            <div class="form-group row">
              <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>
              
              <div class="col-md-6">
                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>
                
                @error('date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="sender_id" class="col-md-4 col-form-label text-md-right">{{ __('Pengirim') }}</label>
              
              <div class="col-md-6">
                <select name="sender_id" id="sender_id" class="form-control">
                  <option value="baru">Tambah baru</option>
                  @foreach ($senders as $sender)
                  <option value="{{ $sender->id }}">{{ $sender->name }}</option>
                  @endforeach
                </select>
                
                @error('sender_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            
            <div id="div-sender">
              <div class="form-group row">
                <label for="sender_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pengirim') }}</label>
                
                <div class="col-md-6">
                  <input id="sender_name" type="text" class="form-control @error('sender_name') is-invalid @enderror" name="sender_name" value="{{ old('sender_name') }}">
                  
                  @error('sender_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
                        
            <div class="form-group row">
              <label for="receiver_id" class="col-md-4 col-form-label text-md-right">{{ __('Penerima') }}</label>
              
              <div class="col-md-6">
                <select name="receiver_id" id="receiver_id" class="form-control">
                  <option value="baru">Tambah baru</option>
                  @foreach ($receivers as $receiver)
                  <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                  @endforeach
                </select>
                
                @error('receiver_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div id="div-receiver">
              <div class="form-group row">
                <label for="receiver_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Penerima') }}</label>
                
                <div class="col-md-6">
                  <input id="receiver_name" type="text" class="form-control @error('receiver_name') is-invalid @enderror" name="receiver_name" value="{{ old('receiver_name') }}">
                  
                  @error('receiver_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="PO" class="col-md-4 col-form-label text-md-right">{{ __('PO ke-') }}</label>
              
              <div class="col-md-6">
                <input id="PO" type="number" class="form-control @error('PO') is-invalid @enderror" name="PO" value="{{ old('PO') }}">
                
                @error('PO')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>



            <div class="row">
              <div class="col offset-md-4">
              <table class="table" id="table-cart">
                <thead>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
                  <th></th>
                </thead>
                <tbody id="tb-cart">
                  <tr>
                    <td>
                    <select name="size[]" id="size1" class="form-control">
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="XXL">XXL</option>
                    </select>
                  </td>
                  <td>
                    <select name="color[]" id="color1" class="form-control">
                      <option value="Hitam">Hitam</option>
                      <option value="Biru">Biru</option>
                      <option value="Hijau">Hijau</option>
                      <option value="Abu-abu">Abu-abu</option>
                      <option value="Putih">Putih</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" name="amount[]" id="amount1" class="form-control">
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-sm" id="btn-add">+</button>
                    <td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Tambah') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $( document ).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    

    $("#sender_id").change(function(){
      if ($("#sender_id").val() != "baru") {
        $("#div-sender").hide();
      } else {
        $("#div-sender").show();
      }
    });
    
    $("#receiver_id").change(function(){
      if ($("#receiver_id").val() != "baru") {
        $("#div-receiver").hide();
      } else {
        $("#div-receiver").show();
      }
    });
    
   

    var i = 1;

    $('#btn-add').click(function(){  
           i++;  
           $('#tb-cart').append('<tr id="row'+i+'"><td><select name="size[]" id="size'+i+'" class="form-control"><option value="S">S</option><option value="M">M</option><option value="L">L</option><option value="XL">XL</option><option value="XXL">XXL</option></select></td><td><select name="color[]" id="color'+i+'" class="form-control"><option value="Hitam">Hitam</option><option value="Biru">Biru</option><option value="Hijau">Hijau</option><option value="Abu-abu">Abu-abu</option><option value="Putih">Putih</option>  </select></td><td>  <input type="number" name="amount[]" id="amount'+i+'" class="form-control"></td><td>   <button class="btn btn-danger btn-sm btn-remove" id="'+i+'" >-</button></td></tr>');  
      });


      $(document).on('click', '.btn-remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

  });
</script>
@endsection