@extends('layouts.master')
​
@section('title')
    <title>Edit Data Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                            
                            @if ($message = Session::get('error'))
				                <div class="alert alert-error alert-block">
					            <strong>{{ $message }}</strong>
				                </div>
			            	@endif
                            
                            <form action="{{ route('produk.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="category_id" 
                                        required class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $products->category_id ? 'selected':'' }}>
                                                {{ ucfirst($row->nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="nama" required 
                                        value="{{ $products->nama }}"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">{{ $products->deskripsi }}</textarea>
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stok" required 
                                        value="{{ $products->stok }}"
                                        class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stok') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="number" name="harga" required 
                                        value="{{ $products->harga }}"
                                        class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                    <p class="text-danger">{{ $errors->first('foto') }}</p>
                                    @if (!empty($products->foto))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $products->foto) }}" 
                                            alt="{{ $products->nama }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </form>
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