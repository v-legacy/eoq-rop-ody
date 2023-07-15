<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Barang Keluar';

        $data = BarangKeluar::all();

        return view('pages.barangkeluar.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Barang Keluar';
        $barang = Barang::all();

        return view('pages.barangkeluar.tambah', ['title' => $title, 'barang' => $barang]);
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
            'barang_id'     => 'required',
            'qty_keluar'    => 'required',
            'tanggal_keluar' => 'required'
        ]);

        try {
            $barang = Barang::where('id', $request->barang_id)->first();
            if ($request->qty_keluar < $barang->stock) {
                $barangKeluar = new BarangKeluar();
                $barangKeluar->barang_id = $request->barang_id;
                $barangKeluar->qty_keluar = $request->qty_keluar;
                $barangKeluar->tanggal_keluar = $request->tanggal_keluar;
                $barangKeluar->save();

                $temp = $barang->stock - $barangKeluar->qty_keluar;
                $barang->stock = $temp;
                $barang->update();

                $result = new PerhitunganController();
                $result->getEoq($barangKeluar->qty_keluar, $barangKeluar->id, $barangKeluar->barang_id);

                return redirect('daftar-barang-keluar')->with('success', 'Barang Keluar Berhasil ditambahkan...!');
            } else {
                $error = 'Oops Stock Tidak Cukup...!';
                return back()->with('stock', $error);
            }
        } catch (\Exception $e) {
            return redirect('daftar-barang-keluar')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {
        $title = 'Detail Hasil Perhitungan';
        $data = Perhitungan::where('barang_keluar_id', $barangKeluar->id)->first();

        return view('pages.barangkeluar.detail', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $title = 'Form Edit Barang Keluar';
        $barang = Barang::all();
        return view('pages.barangkeluar.edit', ['title' => $title, 'barang' => $barang, 'barangkeluar' => $barangKeluar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $this->validate($request, [
            'barang_id'     => 'required',
            'qty_keluar'    => 'required',
            'tanggal_keluar' => 'required'
        ]);

        try {
            $barang = Barang::where('id', $request->barang_id)->first();
            if ($request->qty_keluar < $barang->stock) {

                $barangKeluar->barang_id = $request->barang_id;
                $temp = $barang->stock + $barangKeluar->qty_keluar;
                $barang->stock = $temp;

                $barangKeluar->qty_keluar = $request->qty_keluar;
                $barangKeluar->tanggal_keluar = $request->tanggal_keluar;
                $barangKeluar->save();

                $barang->stock = $temp - $barangKeluar->qty_keluar;
                $barang->update();

                $result = new PerhitunganController();
                $result->getEoq($barangKeluar->qty_keluar, $barangKeluar->id, $barangKeluar->barang_id);

                return redirect('daftar-barang-keluar')->with('success', 'Barang Keluar Berhasil ditambahkan...!');
            } else {
                $error = 'Oops Stock Tidak Cukup...!';
                return back()->with('stock', $error);
            }
        } catch (\Exception $e) {
            return redirect('daftar-barang-keluar')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        $barang = Barang::where('id', $barangKeluar->barang_id)->first();
        $barang->stock = $barang->stock + $barangKeluar->qty_keluar;
        $barang->update();

        $barangKeluar->delete();

        return back()->with('success', 'Barang Keluar berhasil dihapus...!');
    }
}
