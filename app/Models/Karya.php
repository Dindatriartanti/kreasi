<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;

    protected $table = 'karya';

    protected $primaryKey = 'id_karya';

    protected $fillable = [
        'id_kontributor',
        'id_kategori_kontributor',
        'judul_karya',
        'slug',
        'deskripsi_karya',
        'thumbnail',
        'file_karya',
        'tanggal_upload',
        'status',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];

    public function kontributor()
    {
        return $this->belongsTo(Kontributor::class, 'id_kontributor', 'id_kontributor');
    }

    public function kategoriKontributor()
    {
        return $this->belongsTo(
            KategoriKontributor::class,
            'id_kategori_kontributor',
            'id_kategori_kontributor'
        );
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

}