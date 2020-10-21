@extends('layouts.master')
​
@section('title')
    <title>Edit Data Konsumen</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customer</a></li>
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
                            
                            <form action="{{ route('customers.update', $customers->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" name="nik" required 
                                        value="{{ $customers->nik }}"
                                        class="form-control {{ $errors->has('nik') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nik') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" required 
                                        value="{{ $customers->nama }}"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon</label>
                                    <input type="text" name="telepon" required 
                                        value="{{ $customers->telepon }}"
                                        class="form-control {{ $errors->has('telepon') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('telepon') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" required 
                                        value="{{ $customers->alamat }}"
                                        class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
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