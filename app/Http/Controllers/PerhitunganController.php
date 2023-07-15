<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Perhitungan;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\BiayaPenyimpanan;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        $title =  'Daftar Hasil Perhitungan';
        $data  = Perhitungan::all();

        return view('pages.perhitungan.index', ['title' => $title, 'data' => $data]);
    }
    public function getEoq($qty_keluar, $bk_id, $barang_id)
    {
        $barang =  Barang::where('id', $barang_id)->first();
        $biaya_p = BiayaPenyimpanan::where('barang_id', $barang_id)->first();

        $biayaSimpan = $biaya_p->biaya_simpan;


        $eoq = sqrt(2 * ($qty_keluar * $barang->biaya_pesan) / $biayaSimpan);


        $frekuensi      = $this->getFrekuensi($qty_keluar, $eoq);
        $rop            = $this->getRop($qty_keluar, $bk_id);
        $totalcost      = $this->getTotalCost($biayaSimpan, $barang->biaya_pesan, $eoq, $qty_keluar);
        // dd($totalcost[0], $totalcost[1]);
        if (Perhitungan::where('barang_keluar_id', $bk_id)->exists()) {
            $perhitungan = Perhitungan::where('barang_keluar_id', $bk_id)->first();
            $perhitungan->barang_id              = $barang_id;
            $perhitungan->eoq                    = $eoq;
            $perhitungan->frekuensi              = $frekuensi;
            $perhitungan->rop                    = $rop;
            $perhitungan->total_biaya_simpan     = $totalcost[0];
            $perhitungan->total_biaya_pesan      = $totalcost[1];
            $perhitungan->total_biaya_persediaan = $totalcost[2];
            $perhitungan->update();
        } else {
            $perhitungan = new Perhitungan();
            $perhitungan->barang_keluar_id       = $bk_id;
            $perhitungan->barang_id              = $barang_id;
            $perhitungan->eoq                    = $eoq;
            $perhitungan->frekuensi              = $frekuensi;
            $perhitungan->rop                    = $rop;
            $perhitungan->total_biaya_simpan     = $totalcost[0];
            $perhitungan->total_biaya_pesan      = $totalcost[1];
            $perhitungan->total_biaya_persediaan = $totalcost[2];
            $perhitungan->save();
        }
    }

    public function getFrekuensi($qty_keluar, $eoq)
    {
        $frekuensi = $qty_keluar / $eoq;
        return round($frekuensi, 0, PHP_ROUND_HALF_UP);;
    }

    public function getRop($qty_keluar, $id)
    {
        $barangKeluar = BarangKeluar::where('id', $id)->first();

        $getDays = $barangKeluar->tanggal_keluar;

        $explodedate = explode('-', $getDays);
        $callender = CAL_GREGORIAN;
        $bulan     = (int) $explodedate[1];
        $tahun     = (int) $explodedate[0];

        $hari      = cal_days_in_month($callender, $bulan, $tahun);

        $getresult = ($qty_keluar / $hari) * 1;
        $rop = round($getresult, 0, PHP_ROUND_HALF_UP);

        return $rop;
    }

    public function getTotalCost($biayaSimpan, $biayaPesan, $eoq, $qty)
    {
        $a = $biayaSimpan * (round($eoq) / 2);
        $b = $biayaPesan  * ($qty / round($eoq));
        $total  = round($a, 0, PHP_ROUND_HALF_UP) + round($b, 0, PHP_ROUND_HALF_UP);
        $result = round($total, 0, PHP_ROUND_HALF_UP);

        $cost = [$a, $b, $result];
        return $cost;
    }

    public function reportPerhitungan(Request $request)
    {
        $title = 'Daftar Perhitungan';
        $dari = $request->dari;
        $sampai = $request->sampai;

        // dd($data);
        if (isset($dari) && isset($sampai)) {
            $result = 'Data ditemukan';
            $data = DB::table('perhitungan')
                ->join('barang_keluar', 'perhitungan.barang_keluar_id', '=', 'barang_keluar.id')
                ->join('barang', 'perhitungan.barang_id', '=', 'barang.id')
                ->select('perhitungan.*', 'barang.nama_barang', 'barang_keluar.tanggal_keluar')
                ->where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->get();

            $t_simpan = DB::table('perhitungan')
                ->join('barang_keluar', 'perhitungan.barang_keluar_id', '=', 'barang_keluar.id')
                ->join('barang', 'perhitungan.barang_id', '=', 'barang.id')
                ->select('perhitungan.*', 'barang.nama_barang', 'barang_keluar.tanggal_keluar')
                ->where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->sum('total_biaya_simpan');

            $t_pesan = DB::table('perhitungan')
                ->join('barang_keluar', 'perhitungan.barang_keluar_id', '=', 'barang_keluar.id')
                ->join('barang', 'perhitungan.barang_id', '=', 'barang.id')
                ->select('perhitungan.*', 'barang.nama_barang', 'barang_keluar.tanggal_keluar')
                ->where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->sum('total_biaya_pesan');
            $t_persediaan = DB::table('perhitungan')
                ->join('barang_keluar', 'perhitungan.barang_keluar_id', '=', 'barang_keluar.id')
                ->join('barang', 'perhitungan.barang_id', '=', 'barang.id')
                ->select('perhitungan.*', 'barang.nama_barang', 'barang_keluar.tanggal_keluar')
                ->where('tanggal_keluar', '>=', $dari)
                ->where('tanggal_keluar', '<=', $sampai)
                ->sum('total_biaya_persediaan');



            return view('pages.report', [
                'title' => $title,
                'result' => $result,
                'data' => $data,
                't_simpan' => $t_simpan,
                't_pesan' => $t_pesan,
                't_persediaan' => $t_persediaan
            ]);
        } else {
            $result = 'Data Tidak ditemukan';
            return view('pages.report', ['title' => $title, 'result' => $result]);
        }

        return view('pages.report', ['title' => $title]);
    }
}
