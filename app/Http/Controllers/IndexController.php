<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        // Mostrar las recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 0)->get();
        $liked = Post::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        // Obtener las recetas mas nuevas
        $latest = Post::latest()->take(2)->get();

        // obtener todas las categorias
        $categories = Category::all();
        // return $categorias;

        // Agrupar las recetas por categoria
        $posts = [];

        foreach($categories as $category) {
            $posts[ Str::slug( $category->name ) ][] = Post::where('category_id', $category->id )->take(3)->get();
        }

        // return $recetas;


        return view('home.index', compact('latest', 'posts', 'liked'));
    }
}
