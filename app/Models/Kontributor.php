<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontributor extends Model
{
    use HasFactory;

    protected $table = 'kontributor';

    protected $primaryKey = 'id_kontributor';

    protected $fillable = [
        'id_user',
        'nama_kontributor',
        'slug',
        'deskripsi',
        'alamat',
        'no_hp',
        'email',
        'instagram',
        'facebook',
        'youtube',
        'website',
        'foto_profil',
        'foto_banner',
        'bukti_karya',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    public function karya()
    {
        return $this->hasMany(
            Karya::class,
            'id_kontributor',
            'id_kontributor'
        );
    }

    public function rating()
    {
        return $this->hasMany(
            RatingKontributor::class,
            'id_kontributor',
            'id_kontributor'
        );
    }
    
    public function karyaPublish()
    {
        return $this->hasMany(
            Karya::class,
            'id_kontributor',
            'id_kontributor'
        )->where('status', 'publish');
    }

    public function karyaReview()
    {
        return $this->hasMany(
            Karya::class,
            'id_kontributor',
            'id_kontributor'
        )->where('status', 'review');
    }
}