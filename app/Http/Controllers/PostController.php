<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->recetas->dd();
        // $recetas = auth()->user()->recetas->paginate(2);

        $user = auth()->user();

        // Recetas con paginación
        $posts = Post::where('user_id', $user->id)->paginate(5);

        return view('posts.index')
            ->with('posts', $posts)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();

        // Obtener las categorias (sin modelo)
        // $categorias =  DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        // Con modelo
        $categories = Category::all(['id', 'name']);

        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // dd(  $request['imagen']->store('upload-recetas', 'public') );


        // validación
        $data = $request->validate([
            'title' => 'required|min:6',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'required|image'
        ]);

        // obtener la ruta de la imagen
        $ruta_imagen = $request['image']->store('upload-posts', 'public');

        // Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        // almacenar en la bd (sin modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);

        // almacenar en la BD (con modelo)
        auth()->user()->posts()->create([
             'title' => $data['title'],
             'content' => $data['content'],
             'image' => $ruta_imagen,
             'category_id' => $data['category_id']
        ]);

        // Redireccionar
        return redirect()->action([PostController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( auth()->user() ) ?  auth()->user()->meGusta->contains($post->id) : false; 

        // Pasa la cantidad de likes a la vista
        $likes = $post->likes->count();

        return view('posts.show', compact('post', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Revisar el policy
        $this->authorize('view', $post);

        // Con modelo
        $categories = Category::all(['id', 'name']);

        return view('posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Revisar el policy
        $this->authorize('update', $post);

        // validación
        $data = $request->validate([
            'title' => 'required|min:6',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        // Asignar los valores
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];


        // Si el usuario sube una nueva imagen
        if(request('image')) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['image']->store('upload-posts', 'public');

            // Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            // Asignar al objeto
            $post->image = $ruta_imagen;
        }

        $post->save();

        // redireccionar
        return redirect()->action([PostController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Ejecutar el Policy
        $this->authorize('delete', $post);

        // Eliminar la receta
        $post->delete();

        return redirect()->action([PostController::class, 'index']);
    }

    public function search(Request $request) 
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $posts = Post::where('title', 'like', '%' . $busqueda . '%')->paginate(10);
        $posts->appends(['buscar' => $busqueda]);

        return view('search.show', compact('posts', 'busqueda'));
    }
}
