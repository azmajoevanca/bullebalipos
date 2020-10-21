@extends('layouts.master')
​
@section('title')
    <title>Manajemen Order</title>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
    <style>
        .product-img{
            width: 100%;
            max-height: 220px;
            padding-bottom: 20px;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pilih Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Manajemen Order</a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-lg-4">
            <img class="product-img" src="{{ asset('uploads/product/' . $product->foto) }}" alt="{{ $product->nama }}">               
            <div class="card-body">
                    <div class="d-flex no-block align-items-center mb-3">
                        <span><strong>{{number_format($product->harga)}} / Hari</strong></span>
                        <div class="ml-auto">
                            <span><i class="ti-car"></i> {{$product->category->nama}}</span>
                        </div>
                    </div>
                    <h3>{{$product->nama}}</h3>
                    <div class="d-flex no-block align-items-center pb-3">
                        <span class="text-muted">Tersedia</span>
                    </div>
                    <div id="accordion" class="accordion">

                                <h5 class="mb-0">
                                    <button class="btn btn-block btn-info" data-toggle="collapse" data-target="#collapse{{$product->id}}" aria-expanded="true" aria-controls="collapse{{$product->id}}">
                                     SEWA
                                    </button>
                                </h5>
                    </div>
                    <div id="collapse{{$product->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <form action="/order/calculate" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group">
                                        <label>Kode Booking</label>
                                        <input type="text" name="boking_code" readonly required value="B-{{rand()}}" class="form-control">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="product_id" readonly required value="{{$product->category->nama}}" class="form-control">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="#customers">Plih Penyewa</label><br>
                                        <select type="text" class="form-control" name="customer_id" id="customers">
                                            <option disabled selected >-- Pilih Penyewa --</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->id}} - {{$customer->nama}}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Order</label>
                                        <input type="date" name="tanggal_order" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Durasi</label>
                                        <input type="number" class="form-control" name="durasi">
                                    </div>
                                    <button type="submit" class="btn btn-block btn-secondary">Proses</button>

                                    </form>
                                </div>
                        </div>      
            </div>
        </div>
        @endforeach
    </div>
    </div>
    </section>
</div>
@endsection
@section('script')
<script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('dist/js/pages/forms/select2/select2.init.js')}}"></script>

@endsection
            