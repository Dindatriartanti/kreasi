<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $primaryKey = 'id_kegiatan';

    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama_kegiatan',
        'slug',
        'deskripsi_kegiatan',
        'poster',
        'lokasi_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'kuota',
        'is_booking',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}