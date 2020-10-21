<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
            <form action="/order/calculate" method="post">
            @csrf
            <div class="form-group">
                <label>Kode Booking</label>
                <input type="text" name="boking_code" readonly required value="B-{{rand()}}" class="form-control">
            </div>
            
            </form>
            <div class="form-group">
            </div>
            <div class="form-group">
                    <p>Jumlah</p>
                    <input type="text" name="jumlah" readonly required value="{{$data['jumlah']}}" class="form-control">
            </div>
           
            <div class="form-group">
                    <p>Total Harga</p>
                    <input type="text" name="total_harga" readonly required value="{{($total_harga)}}" class="form-control">
            </div>
                <div class="form-group">
                    <p>Paid Type</p>
                    <select name="type" class="form-control">
                        <option disabled selected> - Select One - </option>
                        <option value="DP">DP</option>
                        <option value="REPAYMENT">Repayment</option>
                    </select>
                </div>
                <div class="form-group">
                    <p>Amount</p>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Process</button>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('dist/js/pages/forms/select2/select2.init.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#customers').select2();
    })
</script>
@endsection