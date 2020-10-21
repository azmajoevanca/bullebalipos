@extends('layouts.master')
@section('title')
    <title>Informasi Rental</title>
@endsection 
@section('css')
<link rel="stylesheet" href="{{ asset('dist/css/style-jo.css') }}">
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 672px;">
    <div class="content-header">
        <div class="card material-card">
            <div class="card-body">
                <h3>Information Rental | <strong>{{$order->boking_code}}</strong></h3>
                <p class="card-subtitle">Ini adalah data informasi penyewaan kostum dengan kode booking <strong>{{$order->boking_code}}</strong></p>
            <div class="row">
                <div class="col-lg-6">
                <form action="/return/store" method="POST">
                    @csrf
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Kode Booking </td>
                                <td>:</td>
                                <th>{{$order->boking_code}}</th>
                            </tr>
                            
                            <tr>
                                <td>Kostum </td>
                                <td>:</td>
                                <th>{{$order->product->nama}}</th>
                            </tr>
                            <tr>
                                <td>Tanggal Rental </td>
                                <td>:</td>
                                <th>{{$order->tanggal_order}}</th>
                            </tr>
                            <tr>
                                <td>Duration </td>
                                <td>:</td>
                                <th>{{$order->durasi}} Hari</th>
                            </tr>
                            <tr>
                                <td>Tanggal Pengembalian Seharusnya </td>
                                <td>:</td>
                                <th>{{$order->tanggal_kembali_seharusnya}}</th>
                            </tr>
                            
                        </tbody>
                    </table>
                    <label>Foto Mobil</label>
                </div> 
                <div class="col-lg-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Harga Kostum / Hari </td>
                                <td>:</td>
                                <th>Rp. {{number_format($order->product->harga)}}</th>
                            </tr>
                            <tr>
                                <td>Waktu Penyewaan </td>
                                <td>:</td>
                                <th>{{$order->durasi}} Hari</th>
                            </tr>
                            <tr>
                                <td>Telat Pengembalian </td>
                                <td>:</td>
                                <th> 
                                @if ($data['late'] <= 0)
                                    0
                                @else
                                {{$data['late']}}
                                @endif Hari</th>
                            </tr>
                            <tr>
                                <td>Denda <br>
                                <small class="text-muted">Denda, 10% dari harga sewa kostum /hari + harga sewa /hari</small><br>
                                </td>
                                <td>:</td>
                                <th>
                                    <input readonly class="inputDenda form-control" type="number" value="{{$data['denda']}}" name="denda">
                                    <small class="text-muted">Klik 2x untuk tambah denda</small>
                                </th>
                            </tr>
                            <tr>
                                <td>Sudah Dibayar / DP</td>
                                <td>:</td>
                                <th>RP. {{number_format($data['dp'])}}</th>
                            </tr>
                            <tr>
                                <td>Sisa yang harus dibayar</td>
                                <td>:</td>
                                <th><input readonly class="form-control" type="number" id="total" name="total_harga" ></th>
                                
                            </tr>

                        </tbody>
                    </table>
                    <input type="hidden" name="total_harga" value="{{$data['total']}}">
                    <input type="hidden" name="product_id" value="{{$order->product_id}}">
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="boking_code" value="{{$order->boking_code}}">
                    <input type="submit" value="Process" class="btn-block btn btn-primary">
                    </form>
                </div> 
                
                              
            </div>
        </div>
    </div>
    </div>

</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(e){
        let totalInput = $('#total')
        let dendaInput = $('.inputDenda')
        // dendaInput.val("{{$data['denda']}}")
        let valueTotal = "{{$data['total']}}" 
        console.log("{{$data['total']}}" );
        totalInput.val(valueTotal)   

        if(dendaInput.val() == ''){
            totalInput.val()
        }else{
            totalInput.val(parseInt(totalInput.val()) + parseInt(dendaInput.val()))
        }
        

        $('.inputDenda').dblclick(function(){
            $(this).removeAttr('readonly')
        })

        dendaInput.on("input", function(){
            var $denda = parseInt($(this).val())
            var $total = parseInt(valueTotal) + $denda

            totalInput.val($total)
        })


        })

    </script>
@endsection
