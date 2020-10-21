@extends('layouts.master')
​
@section('title')
<head>
<title>Manajemen Customers</title>
</head>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Customers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Manajemen Master</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @component ('components.card')
                        @slot('title')
                            <a href="{{ route('customers.create') }}" 
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
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
    <tbody>
                                    @forelse ($customers as $row)
    <tr>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->nama}}</td>
                                            <td>{{ $row->telepon }}</td>
                                            <td>{{ $row->alamat }}</td>
                <td>
                <form action="{{ route('customers.destroy', $row->id) }}" onsubmit= "return confirm ('Apakah Yakin Akan Di Hapus?')" method="POST">
                    @csrf
                <input type="hidden" name="_method" value="DELETE">
                <a href="{{ route('customers.edit', $row->id) }}" 
                    class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>
                <a data-nik="{{$row->nik}}" data-customers_id="{{$row->id}}" data-nama="{{$row->nama}}"  
                  data-alamat="{{$row->alamat}}" data-toggle="modal" data-target="#exampleModal-show" 
                  type="button"class="btn btn-default btn-sm fa fa-info"></a> 
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
        {!! $customers->links() !!}
    </div>
    </div>
                            @slot('footer')
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- Modal -->
<div class="modal fade bottom" id="exampleModal-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg modal-right modal-warning" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('customers.show','customers_id')}}" method="get"> 
        @csrf
        <!-- @method('PUT') -->
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">NIK</span>
          </div>
          <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" readonly>
          </div>
          <br>
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Nama</span>
          </div>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" readonly>
          </div>
          <input type="hidden" id="customers_id" name="customers_id">
          <br>
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Alamat</span>
          </div>
          <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" readonly>
          </div>
          <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-warning">Show Student</button> -->
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal
    <div class="modal fade" id="#myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div> -->

<!-- <script>
     $(document).ready(function(){
        $("#btn").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>    -->
@endsection
@section('js')
<script>
$('#exampleModal-show').on('show.bs.modal', function(event){
var button = $(event.relatedTarget)
var nik = button.data('nik')
var nama = button.data('nama')
var alamat = button.data('alamat')
var customers_id = button.data('customers_id')
var modal = $(this)
modal.find('.modal-title').text('VIEW CUSTOMERS INFORMATION');
modal.find('.modal-body #nik').val(nik);
modal.find('.modal-body #nama').val(nama);
modal.find('.modal-body #alamat').val(alamat);
modal.find('.modal-body #customers_id').val(customers_id);
});
</script>
@endsection



