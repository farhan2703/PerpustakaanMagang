<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $table = 'member'; // Make sure this matches your table name
    protected $primaryKey = 'id_member';
    protected $guard_name = 'web';
<<<<<<< HEAD
    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'password',
        'foto_profil',
    ];
=======
    protected $fillable = ['nama', 'no_telepon', 'email', 'password', 'photo'];
>>>>>>> 979fa5ed7ed95eeb86ca65c6764f0377babfa120

    protected $hidden = [
        'password',
        'remember_token',
    ];}