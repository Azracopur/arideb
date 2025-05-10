<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Roles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Kullanıcının rollerini tanımlar
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    // Kullanıcının belirli bir role sahip olup olmadığını kontrol eder
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }
}
