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
                        <h1 class="m-0 text-dark">Manajemen Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Manajemen Master</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @component ('components.card')
                            @slot('title')
                            Form Order
                            @endslot             
                            <table>
                                    <div class="form-group">
                                        <label for="#customers">Plih Penyewa</label><br>
                                            <select type="text" class="form-control" name="customer_id[]" id="customers">
                                                <option disabled selected >Pilih Penyewa</option>
                                                    @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->id}} - {{$customer->nama}}</option>
                                                    @endforeach
                                            </select>                                    
                                    </div>
                                    <thead>
                                    <tr>
                                        <th>
                                        <div class="form-group">
                                           <select type="text" class="form-control" name="product_id" id="products">
                                                <option disabled selected >Pilih Produk</option>
                                                    @foreach ($products as $product)
                                                <option value="{{$product->id}}" >{{$product->id}} - {{$product->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        </th>
                                        <th><div class= "form-group">
                                            <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah">
                                        </div></th>
                                        <th><div class="form-group">
                                            <input type="date" name="tanggal_order[]" class="form-control" placeholder="Tanggal Order">
                                        </div></th>
                                        <th><div class="form-group">
                                            <input type="number" name="durasi[]" class="form-control" placeholder="Durasi">
                                        </div></th> 
                                        <th><div class="form-group">
                                            <input type="number" name="harga[]" class="form-control"  placeholder="harga">
                                        </div></th> 
                                        <th style="text-align:center">
                                            <div class="form-group">
                                                <button class="btn btn-info" onClick="addRow()"> <i class="fa fa-plus"></i></button>  
                                                <button class="btn btn-danger remove"><i class="fa fa-trash"></i></button>                                            
                                            </div>                                
                                        </th>  
                                    </tr>
                                    </thead>
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
@section('js')
    <script type="text/javascript">
    function addRow(){
            var tr = '<tr>'+
                            '<th><div class="form-group">'+
                                '<select type="text" class="form-control" name="product_id" id="products">'+
                                    '<option disabled selected >Pilih Produk</option>'+
                                        '@foreach ($products as $product)'+
                                    '<option value="{{$product->id}}">{{$product->id}} - {{$product->nama}}</option>'+
                                        '@endforeach'+
                                '</select>'+
                            '</div></th>'+
                            '<th><div class= "form-group">'+
                                '<input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah">'+
                            '</div></th>'+
                            '<th><div class="form-group">'+
                                '<input type="date" name="tanggal_order[]" class="form-control" placeholder="Tanggal Order">'+
                            '</div></th>'+
                            '<th><div class="form-group">'+
                                '<input type="number" name="durasi[]" class="form-control" placeholder="Durasi">'+
                            '</div></th>'+ 
                            '<th><div class="form-group">'+
                                '<input type="number" name="harga[]" class="form-control" placeholder="harga">'+
                            '</div></th> '+
                            '<th style="text-align:center">'+
                                '<div class="form-group">'+
                                    '<button class="btn btn-info" onClick="addRow()"> <i class="fa fa-plus"></i></button>'+  
                                    '<button class="btn btn-danger remove"><i class="fa fa-trash"></i></button>'+                                            
                                '</div>'+                                
                            '</th>'+  
                            '</tr>';
                    $('thead').append(tr);
        };
        $('thead').on('click','.remove',function(){
            var last=$('thead tr').length;
            if (last==1){
                alert ("Jangan di deleted");
            }
            else {
                $(this).parent().parent().parent().remove();
            }
        });
    </script>
@endsection