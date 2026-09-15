<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    public $timestamps = true;

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'icon',
        'status',
    ];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_kategori', 'id_kategori');
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksi::class, 'id_kategori', 'id_kategori');
    }

    public function kategoriKontributor()
    {
        return $this->hasMany(KategoriKontributor::class, 'id_kategori', 'id_kategori');
    }
}