<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, CanResetPassword;

    protected $table = 'admin'; // nama tabel di database
    protected $connection = 'mongodb';

    protected $fillable = ['nama', 'email', 'username', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
