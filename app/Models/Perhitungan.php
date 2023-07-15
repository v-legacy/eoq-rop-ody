<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;
    protected $table = 'perhitungan';
    public $timestamps = false;

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function barangk()
    {
        return $this->belongsTo(BarangKeluar::class, 'barang_keluar_id', 'id');
    }
}
