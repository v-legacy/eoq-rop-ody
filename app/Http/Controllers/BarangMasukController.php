<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\PerhitunganController;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Barang Masuk';
        $data = BarangMasuk::all();
        return view('pages.barangmasuk.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Barang Masuk';
        $supplier = Supplier::all();
        $barang   = Barang::all();


        return view('pages.barangmasuk.tambah', ['title' => $title, 'supplier' => $supplier, 'barang' => $barang]);
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
            'supplier_id'   => 'required',
            'qty_masuk'     => 'required',
            'tanggal_masuk' => 'required'
        ]);

        try {
            $barangmasuk                = new BarangMasuk();
            $barangmasuk->barang_id     = $request->barang_id;
            $barangmasuk->supplier_id   = $request->supplier_id;
            $barangmasuk->qty_masuk     = $request->qty_masuk;
            // $barangmasuk->harga_beli    = $request->harga_beli;
            // $barangmasuk->persentase    = $request->persentase;
            // $barangmasuk->biaya_simpan  = ($barangmasuk->harga_beli / 100) * $barangmasuk->persentase;
            $barangmasuk->tanggal_masuk  = $request->tanggal_masuk;
            $barangmasuk->save();

            $barang = Barang::where('id', $barangmasuk->barang_id)->first();
            $barang->stock = $barang->stock + $barangmasuk->qty_masuk;
            $barang->update();

            // $result = new PerhitunganController();
            // $result->getEoq($barangmasuk->qty, $barangmasuk->biaya_simpan, $barangmasuk->id, $barangmasuk->barang_id);


            return redirect('daftar-barang-masuk')->with('success', 'Barang Masuk berhasil ditambah...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang-masuk')->with('failed', $e->getMessage());
        }
    }

    public function resultEoQ()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $title = 'Form Edit Barang Masuk';
        $supplier = Supplier::all();
        $barang = Barang::all();

        return view('pages.barangmasuk.edit', ['title' => $title, 'supplier' => $supplier, 'barang' => $barang, 'barangmasuk' => $barangMasuk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $this->validate($request, [
            'barang_id'     => 'required',
            'supplier_id'   => 'required',
            'qty'           => 'required',
            'harga_beli'    => 'required',
            'persentase'    => 'required',
            'tanggal_beli'  => 'required'
        ]);

        try {
            $barang = Barang::where('id', $barangMasuk->barang_id)->first();
            $temp = $barang->stock - $barangMasuk->qty;
            // $barangmasuk                = new BarangMasuk();
            $barangMasuk->barang_id     = $request->barang_id;
            $barangMasuk->supplier_id   = $request->supplier_id;
            $barangMasuk->qty           = $request->qty;
            $barangMasuk->harga_beli    = $request->harga_beli;
            $barangMasuk->persentase    = $request->persentase;
            $barangMasuk->biaya_simpan  = ($barangMasuk->harga_beli / 100) * $barangMasuk->persentase;
            $barangMasuk->tanggal_beli  = $request->tanggal_beli;
            $barangMasuk->save();

            $barang->stock = $temp + $barangMasuk->qty;
            $barang->save();

            // $result = new PerhitunganController();
            // $result->getEoq($barangMasuk->qty, $barangMasuk->biaya_simpan, $barangMasuk->id, $barangMasuk->barang_id);
            // $result->getRop($barangMasuk->qty, );

            return redirect('daftar-barang-masuk')->with('success', 'Barang Masuk berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang-masuk')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        $barang = Barang::where('id', $barangMasuk->id)->first();
        $barang->stock = $barang->stock - $barangMasuk->qty;
        $barang->save();

        $barangMasuk->delete();

        return back()->with('success', 'Barang Masuk berhasil dihapus...!');
    }
}
