<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'user'; // karena nama tabel di migration 'user'
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama', 'username', 'email', 'password', 'foto'];
    protected $hidden = ['password'];
}


