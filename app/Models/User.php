<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    /**
     * ROLE :
     * 1 = Admin
     * 2 = Pengantar
     * 3 = Masyarakat
     */

    protected $fillable = [
        'nama',
        'username',
        'email',
        'telepon',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class,'user_id','id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class,'user_id','id');
    }
}
