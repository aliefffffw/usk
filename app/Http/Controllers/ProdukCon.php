<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProdukCon extends Controller
{
    public function home()
    {
        $barang = DB::table('barang')->get();
        return view('produk', ['barang' => $barang]);
    }

    public function index()
    {
        $barang = DB::table('barang')->get();
        return view('produk ', ['barang' => $barang]);
    }

    public function input()
    {
        return view('tambahproduk');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbproduk
        $file = $request->file('gambar');
        $filename = $request->kode . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        DB::table('barang')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $filename
        ]);
        // alihkan halaman ke route barang
        Session::flash('message', 'Input Berhasil.');
        return redirect('/barang/tampil');
    }

    public function update($id)
    {
        // mengambil data barang berdasarkan id yang dipilih
        $barang = DB::table('barang')->where('kode', $id)->get();
        // passing data barang yang didapat ke view edit.blade.php
        return redirect('/barang/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data barang

        DB::table('barang')->where('kode', $request->kode)->update([
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'stok' => $request->stok,
           
        ]);

        // alihkan halaman ke halaman barang
        return redirect('/barang/tampil');
    }

    public function delete($id)
    {
        // mengambil data barang berdasarkan id yang dipilih
        DB::table('barang')->where('kode', $id)->delete();
        // passing data barang yang didapat ke view edit.blade.php
        return redirect('/barang/tampil');
    }
}
