<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKontributor extends Model
{
    use HasFactory;

    protected $table = 'kategori_kontributor';

    protected $primaryKey = 'id_kategori_kontributor';

    protected $fillable = [

        'id_kategori',

        'nama_kategori',

        'slug',

        'deskripsi',

        'status',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Kategori
    |--------------------------------------------------------------------------
    */

    public function kategori()
    {
        return $this->belongsTo(

            Kategori::class,

            'id_kategori',

            'id_kategori'

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Karya
    |--------------------------------------------------------------------------
    */

    public function karya()
    {
        return $this->hasMany(

            Karya::class,

            'id_kategori_kontributor',

            'id_kategori_kontributor'

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    public function scopeAktif($query)
    {
        return $query->where(
            'status',
            'aktif'
        );
    }
}