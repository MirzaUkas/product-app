<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = "staff";

    protected $table = 'staffs';

    protected $fillable = [
        'name',
        'user',
        'gender',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
