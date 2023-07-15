<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    public $timestamps = false;

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
