<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    // Jika kamu menggunakan Laravel 8+ dan model memakai guarded, sebaiknya pakai fillable
    protected $fillable = [
        'nama_venue',
        'lokasi',
        'kapasitas',
    ];

    // Jika kamu pakai timestamps dan di tabel ada kolom created_at, updated_at,
    // biarkan default true, kalau tidak ada, tambahkan:
    // public $timestamps = false;
}
