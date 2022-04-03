<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin() // Vérifie si l utilisateur est admin
    {
        return $this->roles()->where('name', 'admin')->first();
    }

    public function isEditor() // Vérifie si l utilisateur est éditeur
    {
        return $this->roles()->where('name', 'editor')->first();
    }

    public function isCreator() // Vérifie si l utilisateur est créateur
    {
        return $this->roles()->where('name', 'creator')->first();
    }

    public function isReader() // Vérifie si l utilisateur est créateur
    {
        return $this->roles()->where('name', 'reader')->first();
    }

    public function hasAnyRole(array $roles) {
        return $this->roles()->whereIn('name', $roles)->first();
    }


}
