<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Barang';

        $data = Barang::all();

        return view('pages.barang.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Barang';
        $barang = new Barang();

        $kode = $barang->getKode();

        return view('pages.barang.tambah', ['title' => $title, 'kategori' => Kategori::all(), 'kode' => $kode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_beli'  => 'required',
            'harga_jual'  => 'required',
            'stock'       => 'required',
            'biaya_pesan' => 'required'
        ]);

        try {
            $barang = new Barang();
            $barang->kode_barang = $barang->getKode();
            $barang->nama_barang = $request->nama_barang;
            $barang->kategori_id = $request->kategori_id;
            $barang->harga_beli  = $request->harga_beli;
            $barang->harga_jual  = $request->harga_jual;
            $barang->stock       = $request->stock;
            $barang->biaya_pesan = $request->biaya_pesan;
            $barang->save();

            return redirect('daftar-barang')->with('success', 'Barang berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $title = 'Form Edit Barang';
        $kategori = Kategori::all();

        return view('pages.barang.edit', ['title' => $title, 'barang' => $barang, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_beli'  => 'required',
            'harga_jual'  => 'required',
            'stock'       => 'required',
            'biaya_pesan' => 'required'
        ]);

        try {
            // $barang = new Barang();
            // $barang->kode_barang = $barang->getKode();
            $barang->nama_barang = $request->nama_barang;
            $barang->kategori_id = $request->kategori_id;
            $barang->harga_beli  = $request->harga_beli;
            $barang->harga_jual  = $request->harga_jual;
            $barang->stock       = $request->stock;
            $barang->biaya_pesan = $request->biaya_pesan;
            $barang->save();

            return redirect('daftar-barang')->with('success', 'Barang berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return back()->with('success', 'Barang berhasil dihapus...!');
    }
}
