<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Override the default authentication column
    protected $username = 'username';

    protected $fillable = [
        'name', // Allow mass assignment for the name field
        'email',
        'password',
    ];

    // Other model properties and methods...

    public function role()
    {
        return $this->belongsTo(Role::class); // Assuming your Role model is named Role
    }
}


