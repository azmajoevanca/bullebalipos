<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category :: orderBy ('created_at', 'DESC') -> paginate (10); 
        //query mengurutkan input terakhir & hanya menampilkan 10 data
        return view ('categories.index', compact ('categories'));
    }
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'nama' => 'required|string|max:50',
            'deskripsi' => 'nullable|string'
        ]);
        try {
            $categories = Category::firstOrCreate([
                'nama' => $request->nama
            ], [
                'deskripsi' => $request->deskripsi
            ]);
            return redirect()->back()->with(['success' => 'Kategori: ' . $categories->nama . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }   
    public function destroy($id)
    {
    $categories = Category::findOrFail($id);
    $categories->delete();
    return redirect()->back()->with(['success' => 'Kategori: ' . $categories->nama . ' Telah Dihapus']);
    }
    public function edit($id)
    {
    $categories = Category::findOrFail($id);
    return view('categories.edit', compact('categories'));
    }
    public function update(Request $request, $id)
{
    //validasi form
    $this->validate($request, [
        'nama' => 'required|string|max:50',
        'deskripsi' => 'nullable|string'
    ]);
    try {
        //select data berdasarkan id
        $categories = Category::findOrFail($id);
        //update data
        $categories->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        
        //redirect ke route kategori.index
        return redirect(route('kategori.index'))->with(['success' => 'Kategori: ' . $categories->nama . ' Ditambahkan']);
    } catch (\Exception $e) {
        //jika gagal, redirect ke form yang sama lalu membuat flash message error
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}

}
    

