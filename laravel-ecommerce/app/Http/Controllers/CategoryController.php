<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display list dari resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // inisiasi halaman index pada controller category dan diurutkan secara ascending berdasarkan kolom created_at
        $category = Category::with(['parent'])->orderBy('created_at', 'ASC')->paginate(10);
      
        // inisiasi halaman parent
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();
        return view('categories.index', compact('category', 'parent'));
    }

    /**
     * menapilkan form untuk membuat resouce baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi imputan sebelum di store ke server
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories'
        ]);

        $request->request->add(['slug' => $request->name]);
        Category::create($request->except('_token'));
        return redirect(route('category.index'))->with(['success' => 'Kategori Baru Ditambahkan!']);
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

    // function untuk edit data category
    public function edit($id)
    {
        $category = Category::find($id); 
        $parent = Category::getParent()->orderBy('name', 'ASC')->get(); 
      
        return view('categories.edit', compact('category', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  function untuk update data category
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories,name,' . $id
        ]);

        $category = Category::find($id); 
        $category->update([
            'name' => $request->name,
            'slug' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect(route('category.index'))->with(['success' => 'Kategori Diperbaharui!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // function untuk menghapus data berdasarkan id
    public function destroy($id)
    {
        //FUNGSI INI AKAN MEMBENTUK FIELD BARU YANG BERNAMA child_count dan product_count
        $category = Category::withCount(['child', 'product'])->find($id);
        if ($category->child_count == 0 && $category->product_count == 0) {
            $category->delete();
            return redirect(route('category.index'))->with(['success' => 'Kategori Dihapus!']);
        }
        return redirect(route('category.index'))->with(['error' => 'Kategori Ini Memiliki Anak Kategori atau Produk!']);
    }
}
