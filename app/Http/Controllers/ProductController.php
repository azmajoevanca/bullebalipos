<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use File;
use Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
{
    $products = Product :: with('category')->orderBy('created_at', 'DESC')->paginate(10);
    return view('products.index', compact('products'));
}
public function create()
{
    $categories = Category::orderBy('nama', 'ASC')->get();
    return view('products.create', compact('categories'));
}

public function store(Request $request)
{
    //validasi data
    $this->validate($request, [
        'category_id' => 'required|exists:categories,id',
        'nama' => 'required|string|max:100',
        'deskripsi' => 'nullable|string|max:100',
        'stok' => 'required|integer',
        'harga' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);
    try {
        //default $photo = null
        $foto = null;
        //jika terdapat file (Foto / Gambar) yang dikirim
        if ($request->hasFile('foto')) {
            //maka menjalankan method saveFile()
            $foto = $this->saveFile($request->nama, $request->file('foto'));
        }
        //Simpan data ke dalam table products
        $products = Product::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'available' =>$request->stok,
            'harga' => $request->harga,
            'foto' => $foto
        ]);
        //jika berhasil direct ke produk.index
        return redirect(route('produk.index'))
            ->with(['success' => 'Produk : ' . $products->nama . ' Ditambahkan']);
    } catch (\Exception $e) {
        //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
        return $e;
        return redirect()->back()
            ->with(['error' => $e->getMessage()]);
    }
}
private function saveFile($nama, $foto)
{
    //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
    $images = Str::slug($nama) . time() . '.' . $foto->getClientOriginalExtension();
    //set path untuk menyimpan gambar
    $path = public_path('uploads/product');
    
if (!File::isDirectory($path)) {
    //maka folder tersebut dibuat
    File::makeDirectory($path, 0777, true, true);}
    //simpan gambar yang diuplaod ke folrder uploads/produk
    Image::make($foto)->save($path . '/' . $images);
    //mengembalikan nama file yang ditampung divariable $images
    return $images;
}
public function destroy($id)
{
    //query select berdasarkan id
    $products = Product::findOrFail($id);
    //mengecek, jika field photo tidak null / kosong
    if (!empty($products->foto)) {
        //file akan dihapus dari folder uploads/produk
        File::delete(public_path('uploads/product/' . $products->foto));
    }
    //hapus data dari table
    $products->delete();
    return redirect()->back()->with(['success' =>  'Produk : ' . $products->nama . ' Telah Dihapus!']);
}
public function edit($id)
{
    //query select berdasarkan id
    $products = Product::findOrFail($id);
    $categories = Category::orderBy('nama', 'ASC')->get();
    return view('products.edit', compact('products', 'categories'));
}
public function update(Request $request, $id)
{
    //validasi
    $this->validate($request, [
        'category_id' => 'required|exists:categories,id',
        'nama' => 'required|string|max:100',
        'deskripsi' => 'nullable|string|max:100',
        'stok' => 'required|integer',
        'harga' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);
    try {
        //query select berdasarkan id
        $products = Product::findOrFail($id);
        $foto = $products->foto;
        //cek jika ada file yang dikirim dari form
        if ($request->hasFile('foto')) {
            //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
            !empty($foto) ? File::delete(public_path('uploads/product/' . $foto)):null;
            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
            $foto = $this->saveFile($request->nama, $request->file('foto'));
        }
        //perbaharui data di database
        $products->update([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'foto' => $foto
        ]);
        return redirect(route('produk.index'))

            ->with(['success' => 'Produk : ' . $products->nama . ' Diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()
            ->with(['error' => $e->getMessage()]);
    }
}
}
