<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

//protected $guarded = ['id'];
protected $fillable = [
    'fname',
    'lname',
    'email',
    'phone',
    'password',
    'address',
    'country',
    'City',
    'zip',
    'photo',
];

    protected $guard = 'customer';

}