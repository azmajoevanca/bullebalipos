@extends('layouts.master')
@section('title')
<title>Konfirmasi Penyewaan</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('dist/css/style-jo.css') }}">
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 672px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Data Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost:8000/home">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Transaksi</h3>
                                <div class="card-body">
                                <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Tanggal Order</td>
                                        <th>{{$data['tanggal_order']}}</th>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <th>{{$data['durasi']}} Hari</th>
                                    </tr>
                                    <tr>
                                        <td>Kembali Pada</td>
                                        <th>{{$tanggal_kembali}}</th>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <th>Rp. {{number_format($total_harga)}}</th>
                                    </tr>
                                    <tr>
                                        <td>DP Minimum</td>
                                        <th>Rp. {{number_format($dp)}}</th>
                                    </tr>
                                </tbody>
                                </table>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Produk</h3>
                        </div>
                        <img class="img-product" src="{{ asset('uploads/product/' . $products['foto']) }}" alt="car images">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center mb-3">
                                <span><strong>{{number_format($products['harga'])}} / Hari</strong></span>
                                <div class="ml-auto">
                                    <span><i class="ti-car"></i> {{$products['category']['nama']}}</span>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-info"></i></button>
                                </div>
                            </div>
                            <h3>{{$products['nama']}}</h3>
                            <div class="d-flex no-block align-items-center pb-3">
                                <span class="text-muted">Jumlah : {{$data['jumlah']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button href="#" type="button" data-target="#paymentModal" data-toggle="modal" class="btn btn-block btn-primary">Konfirmasi</button>
    
    <!----Modal-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="card-header">
                            <h3>Data Transaksi</h3>
                                <table class="table">
                                <tbody>
                                   
                                    <tr>
                                        <td>Tanggal Order</td>
                                        <th>{{$data['tanggal_order']}}</th>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <th>{{$data['durasi']}} Hari</th>
                                    </tr>
                                    <tr>
                                        <td>Kembali Pada</td>
                                        <th>{{$tanggal_kembali}}</th>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <th>Rp. {{number_format($total_harga)}}</th>
                                    </tr>
                                    <tr>
                                        <td>DP Minimum</td>
                                        <th>Rp. {{number_format($dp)}}</th>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Detail</button>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="/order/process" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="product_id" value="{{$products['id']}}">
    <input type="hidden" name="tanggal_order" value="{{$data['tanggal_order']}}">
    <input type="hidden" name="durasi" value="{{$data['durasi']}}">
    <input type="hidden" name="jumlah" value="{{$data['jumlah']}}">
    <input type="hidden" name="tanggal_kembali_seharusnya" value="{{$tanggal_kembali}}">
    <input type="hidden" name="total_harga" value="{{$total_harga}}">
    @include('orders.form-payment')
    </form>
@endsection