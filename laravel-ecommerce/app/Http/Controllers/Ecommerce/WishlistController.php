<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use DB;

// Controller ini digunakan untuk menghandle segala sesuatu pengolahan data pada fitur wishlist
class WishlistController extends Controller
{
    // Function index digunakan untuk menampilkan wishlist dari seorang customer pada halaman website yang ditampilkan secara descending
    public function index()
    {
        $wishlists = Wishlist::where('customer_id', auth()->guard('customer')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('ecommerce.wishlists.index', compact('wishlists'));
    }

    // Function saveWishlist digunakan untuk menyimpan product yang disukai ke dalam Wishlist
    public function saveWishlist(Request $request)
    {
        // memvalidasi id product yang ingin dimasukan ke dalam wishlist
        $this->validate($request, [
            'product_id' => 'required|exists:products,id'
        ]); 

        // menyimpan product ke dalam wishlist customer
        Wishlist::create([
            'customer_id' => auth()->guard('customer')->user()->id,
            'product_id' => $request->product_id
        ]);

        return redirect()->back()->with(['success' => 'Produk ditambahkan ke Wishlist']);
    }

    // Function deleteWishlist digunakan untuk menghapus product yang disukai ke dalam Wishlist
    public function deleteWishlist($id)
    {
        // menghapus product dari wishlist berdasarkan id product 
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back()->with(['success' => 'Berhasil Hapus dari daftar Wishlist!']);
    }
        
}
