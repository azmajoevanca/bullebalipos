@extends('layouts.master')
​
@section('title')
    <title>Manajemen Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Manajemen Master</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @component ('components.card')
                            @slot('title')
                            <a href="{{ route('produk.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot
                            @if ($message = Session::get('success'))
				                <div class="alert alert-success alert-block">
					            <strong>{{ $message }}</strong>
				                </div>
			            	@endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Stok</th>
                                            <th>Available</th>
                                            <th>Harga</th>
                                            <th>Last Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($products as $row)
        <tr>
        <td>
            @if (!empty($row->foto))
                <img src="{{ asset('uploads/product/' . $row->foto) }}" 
                alt="{{ $row->nama }}" width="50px" height="50px">
            @else
                <img src="http://via.placeholder.com/50x50" alt="{{ $row->nama}}">
            @endif
        </td>
        <td>{{ $row->category->nama }}</td>
        <td>{{ $row->nama}}</td>
        <td>{{ $row->stok }}</td>
        <td>{{ $row->available }}</td>
        <td>Rp {{ number_format($row->harga) }}</td>
        <td>{{ $row->updated_at }}</td>
        <td>
            <form action="{{ route('produk.destroy', $row->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <a href="{{ route('produk.edit', $row->id) }}" 
                    class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center">Tidak ada data</td>
    </tr>
    @endforelse
</tbody>
                                </table>
                                <div class="float-right">
                         {!! $products->links() !!}
                            </div>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection