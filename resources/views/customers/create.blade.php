@extends('layouts.master')
​
@section('title')
    <title>Tambah Data Customer</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Produk</a></li>
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
                            <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">NIK </label>
                                    <input type="text" name="nik" required 
                                        class="form-control {{ $errors->has('nik') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nik') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama </label>
                                    <input type="text" name="nama" required 
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon </label>
                                    <input type="text" name="telepon" required 
                                        class="form-control {{ $errors->has('telepon') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('telepon') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat </label>
                                    <input type="text" name="alamat" required 
                                        class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
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