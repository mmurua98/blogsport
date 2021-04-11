<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Campos que se agregaran
    protected $fillable = [
        'title', 'content', 'image', 'category_id'
    ];
    
    // Obtiene la categoria de la receta via FK
    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    // Obtiene la información del usuario via FK
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // FK de esta tabla
    }

    // Likes que ha recibido una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
