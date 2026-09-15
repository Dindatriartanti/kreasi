<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKunjungan extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kunjungan';

    protected $fillable = [
        'nama_pemesan',
        'no_hp',
        'email',
        'instansi',
        'tujuan',
        'dewasa',
        'anak',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}