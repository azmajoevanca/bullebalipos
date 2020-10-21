<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class customerController extends Controller
{
    
public function index ()
{
    $customers = Customer :: orderBy ('created_at', 'DESC') -> paginate (10); 
    return view ('customers.index', compact('customers'));
} 
public function create()
{
    $customers = Customer::orderBy('nama', 'ASC')->get();
    return view('customers.create', compact('customers'));
}
public function store(Request $request) 
{
    $this->validate($request,[
        'nik' => 'required|string|max:100',
        'nama'=> 'required|string|max:100',
        'telepon'=>'required|string|max:100',
        'alamat'=>'required|string|max:100'
    ]);
    try {
        $customers = Customer::firstOrCreate([
            'nik' => $request ->nik  ,
            'nama' =>$request->nama ,
            'telepon' =>$request->telepon,
            'alamat'=>$request->alamat
        ]);
        return redirect(route('customers.index'))
        ->with(['success' => 'Customer: ' . $customers->nama . ' Ditambahkan']);
    } catch (\Exception $e) {
        dd("gagal");return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    }
    
    public function destroy($id)
    {
    $customers = Customer::findOrFail($id);
    $customers->delete();
    return redirect()->back()->with(['success' => 'Kategori: ' . $customers->nama . ' Telah Dihapus']);
    }
public function edit($id)
    {
        //query select berdasarkan id
        $customers = Customer::findOrFail($id);
        return view('customers.edit', compact('customers'));
    }
public function update(Request $request, $id)
{
    //validasi
    $this->validate($request,[
        'nik' => 'required|string|max:100',
        'nama'=> 'required|string|max:100',
        'telepon'=>'required|string|max:100',
        'alamat'=>'required|string|max:100'
    ]);
    try {
        $customers = Customer::findOrFail($id);
        $customers ->update ([
            'nik' => $request ->nik  ,
            'nama' =>$request->nama ,
            'telepon' =>$request->telepon,
            'alamat'=>$request->alamat
        ]);
        return redirect(route('customers.index'))

            ->with(['success' => 'Customer dengan nama : ' . $customers->nama . ' Diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()
            ->with(['error' => $e->getMessage()]);
    }
}

}  



