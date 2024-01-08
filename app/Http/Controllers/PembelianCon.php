<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class PembelianCon extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'Guest') {
            $transaksi = DB::table('transaksi')->get();
            return view('pembelian', ['transaksi' => $transaksi]);
        } else {
            $transaksi = DB::table('transaksi')->where('kode_pembeli', Auth::user()->id)->get();
            return view('pembelian', ['transaksi' => $transaksi]);
        }
    }

    public function input()
    {
        return view('tambahpembelian');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbpembelian
        DB::table('transaksi')->insert([
            'kode_produk' => $request->kodeproduk,
            'banyak' => $request->banyak,
            'bayar' => $request->harga * $request->banyak,
            'kode_pembeli' => Auth::user()->id,
            'status' => 'verifikasi'
        ]);
        // alihkan halaman ke route transaksi
        Session::flash('message', 'Input Berhasil.');
        return redirect('/transaksi/tampil');
    }

    public function update($id)
    {
        // mengambil data transaksi berdasarkan id yang dipilih
        $transaksi = DB::table('transaksi')->where('kode_pembelian', $id)->get();
        // passing data transaksi yang didapat ke view edit.blade.php
        return redirect('/transaksi/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data transaksi

        DB::table('transaksi')->where('kode_pembelian', $request->kode_pembelian)->update([
            'status' => $request->status
        ]);

        // alihkan halaman ke halaman transaksi
        return redirect('/transaksi/tampil');
    }

    public function delete($id)
    {
        // mengambil data transaksi berdasarkan id yang dipilih
        DB::table('transaksi')->where('kode_pembelian', $id)->delete();
        // passing data transaksi yang didapat ke view edit.blade.php
        return redirect('/transaksi/tampil');
    }
}
