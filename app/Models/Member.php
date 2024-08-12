<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = 'member'; // Make sure this matches your table name
    protected $primaryKey = 'id_member';
    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];}