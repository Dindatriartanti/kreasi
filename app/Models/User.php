<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'no_hp',
        'foto',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke Kontributor
     * Satu user hanya memiliki satu data kontributor.
     */
    public function kontributor()
    {
        return $this->hasOne(Kontributor::class, 'id_user', 'id');
    }

    /**
     * Cek apakah user adalah Admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah Kontributor
     */
    public function isKontributor()
    {
        return $this->role === 'kontributor';
    }
}