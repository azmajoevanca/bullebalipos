<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use DateTime;
use App\Product;
use Carbon\Carbon;

class returnController extends Controller
{
    public function index(){
        $orders = Order::where('tanggal_kembali', null)->get();
        $products = Product ::all();
        return view('return.index', compact('orders'));
    }

    protected function show($code){
         $order = Order::where('boking_code', $code)->first();
         $order_detail = Order_detail::where('boking_code', $code)->first();
        
        //fine / denda (*10%/hari)
        if($order->tanggal_kembali_seharusnya < date('Y-m-d')){
            $return_supposed = new DateTime($order->tanggal_kembali_seharusnya);
            $return_now = new DateTime(date('Y-m-d'));
            $selisih = $return_supposed->diff($return_now);
            $late = $selisih->days;
            $denda = $order->product->harga * 10 / 100 * $late;
            $data['denda'] = $denda + $order->product->harga * $late;;
    		$data['late'] = $late;
        }else{
            $data['denda'] = null;
            $data['late'] = null;
        }

        $data['total'] = $order_detail['total_harga'] - $order_detail['amount'];
        $data['dp'] = $order_detail['amount'];
        $data['now'] = Carbon::now()->toDateString();
        // dd($data['now']);
        return view('return.show', compact('order', 'data'));
    }

    protected function store(Request $request){
        $order = Order::where('boking_code', $request->boking_code)->first();
        // return $order;
        // return $request->all();
        Order::where('id', $order->id)->first()->update([
            'total_harga' => $request->total_harga,
            'denda' => $request->denda,
            'tanggal_kembali' => date('Y-m-d')
            
        ]);
            // return $order;
        $product = Product::find($request->product_id);
        $product->update([
            'available' => $product->available + $order->jumlah,
        ]);
        // return $order;
        Order_detail::where('order_id', $order->id)->update([
            'type' => 'repayment',
            'amount' => $request->total_harga,
            'boking_code' => $request->boking_code,
        ]);
        return redirect('/return');
    }
}
