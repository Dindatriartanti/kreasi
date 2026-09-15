<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'koleksi';

    protected $primaryKey = 'id_koleksi';

    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama_koleksi',
        'slug',
        'deskripsi',
        'gambar',
        'lokasi',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}