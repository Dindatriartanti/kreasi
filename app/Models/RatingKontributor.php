<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingKontributor extends Model
{
    use HasFactory;

    protected $table = 'rating_kontributor';

    protected $primaryKey = 'id_rating';

    protected $fillable = [
        'id_kontributor',
        'id_user',
        'rating',
        'komentar',
        'status',
    ];

    public function kontributor()
    {
        return $this->belongsTo(
            Kontributor::class,
            'id_kontributor',
            'id_kontributor'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }
}