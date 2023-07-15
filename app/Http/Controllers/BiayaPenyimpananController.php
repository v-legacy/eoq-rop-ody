<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BiayaPenyimpanan;
use Illuminate\Http\Request;

class BiayaPenyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Biaya Penyimpanan';
        $data  = BiayaPenyimpanan::all();

        return view('pages.penyimpanan.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Biaya Penyimpanan';
        $barang = Barang::all();

        return view('pages.penyimpanan.tambah', ['title' => $title, 'barang' => $barang]);
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
            'persentase'    => 'required'
        ]);

        try {
            $barang = Barang::where('id', $request->barang_id)->first();
            $biaya = new BiayaPenyimpanan();
            $biaya->barang_id = $request->barang_id;
            $biaya->persentase = $request->persentase;
            $biaya->biaya_simpan = $barang->harga_beli /  100 * $biaya->persentase;
            $biaya->save();

            return redirect('daftar-biaya')->with('success', 'Biaya Simpan berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-biaya')->with('failed', $e->getMessage());
        }
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
    public function edit($id)
    {
        $title  = 'Form Edit Biaya Simpan';
        $barang = Barang::all();
        $biaya = BiayaPenyimpanan::where('id', $id)->first();

        return view('pages.penyimpanan.edit', ['title' => $title, 'barang' => $barang, 'biaya' => $biaya]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'barang_id'     => 'required',
            'persentase'    => 'required'

        ]);
        try {
            $barang = Barang::where('id', $request->barang_id)->first();
            $biaya = BiayaPenyimpanan::where('id', $id)->first();
            $biaya->barang_id = $request->barang_id;
            $biaya->persentase = $request->persentase;
            $biaya->biaya_simpan =  $barang->harga_beli /  100 * $biaya->persentase;
            $biaya->update();

            return redirect('daftar-biaya')->with('success', 'Biaya Simpan berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('daftar-biaya')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biaya = BiayaPenyimpanan::where('id', $id)->first();
        $biaya->delete();

        return back()->with('success', 'Biaya Penyimpanan Berhasil dihapus..!');
    }
}
