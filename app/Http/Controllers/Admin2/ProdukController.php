<?php

namespace App\Http\Controllers\Admin2;

use App\Helpers\UploadImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function dataProduk()
    {
        $produk = Produk::all();
        return view('layouts.halaman.admin.data-produk', [
            'produk'    => $produk,
        ]);
    }

    public function tambahProduk()
    {
        return view('layouts.halaman.admin.tambah-produk');
    }

    public function simpanProduk(Request $request)
    {
        // Define validation rules for the 'foto' field.
        $rules = [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit
        ];

        // Validate the request against the defined rules.
        $request->validate($rules);

        $produk  = new Produk();
        $produk->nama_produk     = $request->nama_ikan;
        $produk->lebar           = $request->lebar;
        $produk->panjang         = $request->panjang;
        $produk->harga           = $request->harga;
        $produk->stok            = $request->stok;
        $produk->deskripsi       = $request->deskripsi;
        $produk->foto            = UploadImageHelper::uploadImage($request->file('foto'));
        $produk->save();

        return redirect()->back()->with('ok', "Berhasil menambah produk");
    }

    public function editProduk($id)
    {
        $produk = Produk::find($id);
        return view('layouts.halaman.admin.edit-produk', [
            'produk'    => $produk,
        ]);
    }

    public function updateProduk(Request $request)
    {
        $produk  = Produk::find($request->id);

        if ($request->hasFile('foto')) {
            $produk->nama_produk     = $request->nama_ikan;
            $produk->lebar           = $request->lebar;
            $produk->panjang         = $request->panjang;
            $produk->harga           = $request->harga;
            $produk->stok            = $request->stok;
            $produk->deskripsi       = $request->deskripsi;
            $produk->foto            = UploadImageHelper::uploadImage($request->file('foto'));
        } else {
            $produk->nama_produk     = $request->nama_ikan;
            $produk->lebar           = $request->lebar;
            $produk->panjang         = $request->panjang;
            $produk->harga           = $request->harga;
            $produk->stok            = $request->stok;
            $produk->deskripsi       = $request->deskripsi;
        }

        $produk->save();
        return redirect()->route('a.data.produk')->with('ok', "Berhasil mengubah produk");
    }

    public function hapusProduk($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->back()->with('ok', "Berhasil menghapus produk");
    }
}
