<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Evento que se ejecuta cuando un usuario es creado
    protected static function booted()
    {
        parent::boot();

        // Asignar perfil una vez se haya creado un usuario nuevo
        static::created(function ($user) {
            $user->profile()->create();
        });
    }

    /** Relación 1:n de Usuario a Recetas */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relación 1:1 de usuario y perfil
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Recetas que el usuario le ha dado me gusta
    public function meGusta()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }
}
