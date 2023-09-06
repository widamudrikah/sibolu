<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'masyarakat_id',
        'pengantar_id',
        'produk_id',
        'kode',
        'harga',
        'jumlah',
        'harga_total',
        'ongkir',
        'kota',
        'alamat',
        'pembayaran',
        'bukti',
        'status_bayar',
        'status_pesanan',
    ];
}
