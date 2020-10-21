@extends('layouts.master')
@section('title')
<title>Return</title>
@endsection
@section('css-datatables')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 672px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Booking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost:8000/home">Home</a></li>
                        <li class="breadcrumb-item active">Return</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
                <div class="card material-card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="bookingTable" class="table table-striped border display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Kode Booking</th>
                                            <th>Tanggal Rental</th>
                                            <th>Nama Penyewa</th>
                                            <th>Kostum</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->boking_code}}</td>
                                            <td>{{$order->tanggal_order}}</td>
                                            <td>{{$order->customer->nama}}</td>
                                            <td>{{$order->product->nama}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="/return/{{$order->boking_code}}"><i class="ti-eye"></i> Lihat</a>                                 
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $('#bookingTable').DataTable();
    </script>
@endsection
