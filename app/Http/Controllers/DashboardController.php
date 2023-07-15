<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $title          = 'Halaman Dashboard';
        $barangMasuk    = BarangMasuk::count();
        $barangKeluar   = BarangKeluar::count();
        $supplier       = Supplier::count();
        $barang         = Barang::count();


        return view('pages.dashboard.index', ['title' => $title, 'barangMasuk' => $barangMasuk, 'barangKeluar' => $barangKeluar, 'supplier' => $supplier, 'barang' => $barang]);
    }
}
