<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\Order;
use App\Order_detail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $products = Product :: with('category')->orderBy('created_at', 'DESC')->paginate(10);
        $customers = Customer::all();
        return view('orders.index', compact('products','customers'));       
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
        $data = $request->toArray();
        Validator :: make ($data,[
        ]);
        
        $customers = Customer::where('id',$request->customer_id)->first();
        $products = Product::where('id',$request->product_id)->first();
        $tanggal_order=$request->tanggal_order;
        $durasi =$request->durasi;
        $jumlah = $request->jumlah;


        $tanggal_kembali = date('Y-m-d', strtotime('+'.$durasi.'days', strtotime($tanggal_order)));

        // harga total => harga baju/day * durasi peminjaman
        $total_harga = $products['harga'] * $jumlah * $durasi;

        // dp => 30% dari total harga
        $dp = $total_harga * 30 / 100;

    return view('orders.konfirmasi', compact('products', 'tanggal_kembali', 'data', 'total_harga', 'dp', 'jumlah'));
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        
        $customers = Customer::all();
        // $customers = Customer::where('id',$request->customer_id)->first();
        
        $data = $request->toArray();    
        Validator::make($data, [
            'boking_code' => ['required', 'unique:bookings'],
            'tanggal_order' => ['required'],
            'durasi' => ['required'],
            'customer_id' => ['required', 'integer'],
            'product_id' => ['required','integer'],
            'durasi' => ['required','integer'],
            'jumlah' => ['required', 'integer'],
            'tanggal_kembali_seharusnya' => ['required'],
            'type' => ['required'],
            'amount' => ['required','integer'],
        ]);
        //insert to table order first
        $insert_order = Order::create([
            'boking_code' => $request->boking_code,
            'tanggal_order' => $request->tanggal_order,
            'durasi' => $request->durasi,
            'jumlah' => $request->jumlah,
            'tanggal_kembali_seharusnya' => $request->tanggal_kembali_seharusnya,
            'total_harga' => $request->total_harga,
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
        ]);
        //insert to order_detail
        $insert_order_detail = Order_detail::create([

            'type' => $request->type,
            'amount' => $request->amount,
            'order_id' => $insert_order->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            'boking_code' => $request->boking_code
        ]);

        $products = Product::find($request->product_id);
        $products->available = $products->available - $request->jumlah;
        $products->save();
        
        return redirect('/home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

