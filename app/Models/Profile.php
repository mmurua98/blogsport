<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // relación 1:1 de Perfil con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
