<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'nama',
        'no_identity',
        'password',
        'status',
        'user_agent'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
