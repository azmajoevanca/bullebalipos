@extends('layouts.master')
​
@section('title')
    <title>Tambah Data Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
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
                            
                            @endslot
                            @if ($message = Session::get('success'))
				                <div class="alert alert-success alert-block">
					            <strong>{{ $message }}</strong>
				                </div>
			            	@endif
                            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="category_id" 
                                        required class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->nama) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="nama" required 
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}"></textarea>
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stok" required 
                                        class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stok') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="number" name="harga" required 
                                        class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                    <p class="text-danger">{{ $errors->first('foto') }}</p>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection