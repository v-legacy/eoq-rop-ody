<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Supplier';
        $supplier = Supplier::all();
        return view('pages.supplier.index', ['title' => $title, 'data' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Supplier';

        return view('pages.supplier.tambah', ['title' => $title]);
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
            'nama_supplier'     => 'required',
            'email_supplier'    => 'required',
            'no_hp'             => 'required',
            'alamat'            => 'required'
        ]);

        try {
            $supplier = new Supplier();
            $supplier->nama_supplier        = $request->nama_supplier;
            $supplier->email_supplier       = $request->email_supplier;
            $supplier->no_hp                = $request->no_hp;
            $supplier->alamat               = $request->alamat;
            $supplier->save();

            return redirect('daftar-supplier')->with('success', 'Supplier berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-supplier')->with('failed', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $title = 'Form Edit Supplier';

        return view('pages.supplier.edit', ['title' => $title, 'supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'nama_supplier'     => 'required',
            'email_supplier'    => 'required',
            'no_hp'             => 'required',
            'alamat'            => 'required'
        ]);

        try {

            $supplier->nama_supplier        = $request->nama_supplier;
            $supplier->email_supplier       = $request->email_supplier;
            $supplier->no_hp                = $request->no_hp;
            $supplier->alamat               = $request->alamat;
            $supplier->save();

            return redirect('daftar-supplier')->with('success', 'Supplier berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('daftar-supplier')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with('success', 'Supplier berhasil dihapus...!');
    }
}
