@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Order Baru</div>
        
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          
          <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="form-group row">
              <label for="order_no" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Pesanan') }}</label>
              
              <div class="col-md-6">
                <input id="order_no" type="text" class="form-control @error('order_no') is-invalid @enderror" name="order_no" value="{{ old('order_no') }}" required autocomplete="order_no" autofocus>
                
                @error('order_no')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="order_date" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Pesan') }}</label>
              
              <div class="col-md-6">
                <input id="order_date" type="date" class="form-control @error('order_date') is-invalid @enderror" name="order_date" value="{{ old('order_date') }}" required autocomplete="order_date" autofocus>
                
                @error('order_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="store_id" class="col-md-4 col-form-label text-md-right">{{ __('Pengirim') }}</label>
              
              <div class="col-md-6">
                <select name="store_id" id="stores" class="form-control">
                  @foreach ($stores as $store)
                  <option value="{{ $store->id }}">{{ $store->name }}</option>
                  @endforeach
                </select>
                
                @error('store_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Pembeli') }}</label>
              
              <div class="col-md-6">
                <select name="customer_id" id="customer_id" class="form-control">
                  <option value="baru">Tambah baru</option>
                  @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                  @endforeach
                </select>
                
                @error('customer_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div id="div-customer">
            <div class="form-group row">
              <label for="customer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pembeli') }}</label>
              
              <div class="col-md-6">
                <input id="customer_name" type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name') }}">
                
                @error('customer_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="customer_phone" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon Pembeli') }}</label>
              
              <div class="col-md-6">
                <input id="customer_phone" type="text" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ old('customer_phone') }}">
                
                @error('customer_phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="customer_address" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Pembeli') }}</label>
              
              <div class="col-md-6">
                <input id="customer_address" type="text" class="form-control @error('customer_address') is-invalid @enderror" name="customer_address" value="{{ old('customer_address') }}">
                
                @error('customer_address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="province_id" class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>
              
              <div class="col-md-6">
                <select name="province_id" id="province_id" class="form-control">
                  @foreach ($provinces as $province)
                  <option value="{{ $province->id }}">{{ $province->name }}</option>                      
                  @endforeach
                </select>
                
                @error('province_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="regency_id" class="col-md-4 col-form-label text-md-right">{{ __('Kota/Kabupaten') }}</label>
              
              <div class="col-md-6">
                <select name="regency_id" id="regency_id" class="form-control">
                  <option value=""></option>
                </select>
                
                @error('regency_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="district_id" class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan/Distrik') }}</label>
              
              <div class="col-md-6">
                <select name="district_id" id="district_id" class="form-control">
                  <option value=""></option>
                </select>
                
                @error('district_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="village_id" class="col-md-4 col-form-label text-md-right">{{ __('Kelurahan/Desa') }}</label>
              
              <div class="col-md-6">
                <select name="village_id" id="village_id" class="form-control">
                  <option value=""></option>
                </select>
                
                @error('village_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Kode Pos') }}</label>
              
              <div class="col-md-6">
                <input id="postal_code" type="number" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}">
                
                @error('postal_code')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
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
            
            <div class="form-group row">
              <label for="delivery_id" class="col-md-4 col-form-label text-md-right">{{ __('Ekspedisi') }}</label>
              
              <div class="col-md-6">
                <select name="delivery_id" id="delivery_id" required class="form-control">
                  <option value="baru">Tambah baru</option>
                  @foreach ($deliveries as $delivery)
                  <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>                      
                  @endforeach
                </select>
                
                @error('delivery_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row" id="div-delivery-baru">
              <label for="delivery_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ekspedisi') }}</label>
              
              <div class="col-md-6">
                <input id="delivery_name" type="number" class="form-control @error('delivery_name') is-invalid @enderror" name="delivery_name" value="{{ old('delivery_name') }}" autocomplete="delivery_name" autofocus>
                
                @error('delivery_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="estimation_cost" class="col-md-4 col-form-label text-md-right">{{ __('Estimasi Biaya') }}</label>
              
              <div class="col-md-6">
                <input id="estimation_cost" type="number" class="form-control @error('estimation_cost') is-invalid @enderror" name="estimation_cost" value="{{ old('estimation_cost') }}" autocomplete="estimation_cost" autofocus>
                
                @error('estimation_cost')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="total_cost" class="col-md-4 col-form-label text-md-right">{{ __('Total Biaya') }}</label>
              
              <div class="col-md-6">
                <input id="total_cost" type="number" class="form-control @error('total_cost') is-invalid @enderror" name="total_cost" value="{{ old('total_cost') }}" required autocomplete="total_cost" autofocus>
                
                @error('total_cost')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
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
    //untuk memanggil plugin select2
    $('#province_id').select2({
      placeholder: 'Pilih Provinsi',
      language: "id"
    });
    $('#regency_id').select2({
      placeholder: 'Pilih Kota/Kabupaten',
      language: "id"
    });
    $('#district_id').select2({
      placeholder: 'Pilih Kecamatan',
      language: "id"
    });
    $('#village_id').select2({
      placeholder: 'Pilih Kelurahan',
      language: "id"
    });

    $("#customer_id").change(function(){
      if ($("#customer_id").val() != "baru") {
        $("#div-customer").hide();
      } else {
        $("#div-customer").show();
      }
    });
    
    $("#delivery_id").change(function(){
      if ($("#delivery_id").val() != "baru") {
        $("#div-delivery-baru").hide();
      } else {
        $("#div-delivery-baru").show();
      }
    });
    
    //saat pilihan provinsi di pilih, maka akan mengambil data kota
    //di data-wilayah.php menggunakan ajax
    $("#province_id").change(function(){
      // $("img#load1").show();
      var province_id = $(this).val(); 
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "{{ route('address', 'regency') }}",
        data: "id="+province_id,
        success: function(msg){
          $("select#regency_id").html(msg);                                                       
          // $("img#load1").hide();
          getAjaxKota();                                                        
        }
      });                    
    });  
    
    //saat pilihan kota di pilih, maka akan mengambil data kecamatan
    //di data-wilayah.php menggunakan ajax
    $("#regency_id").change(getAjaxKota);
    function getAjaxKota(){
      // $("img#load2").show();
      var id_regencies = $("#regency_id").val();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "{{ route('address', 'district') }}",
        data: "id="+id_regencies,
        success: function(msg){
          $("select#district_id").html(msg);                              
          // $("img#load2").hide(); 
          getAjaxKecamatan();                                                    
        }
      });
    }
    
    //saat pilihan kecamatan di pilih, maka akan mengambil data kelurahan
    //di data-wilayah.php menggunakan ajax
    $("#district_id").change(getAjaxKecamatan);
    function getAjaxKecamatan(){
      // $("img#load3").show();
      var id_district = $("#district_id").val();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "{{ route('address', 'village') }}",
        data: "id="+id_district,
        success: function(msg){
          $("select#village_id").html(msg);                              
          // $("img#load3").hide();                                                 
        }
      });
    }

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