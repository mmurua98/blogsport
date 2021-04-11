<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        // Obtener las recetas con paginación
        $posts = Post::where('user_id', $profile->user_id)->paginate(9);
       
        //
        return view('profiles.show', compact('profile', 'posts') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        // Ejecutar el Policy
        $this->authorize('view', $profile);


        //
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        // Ejecutar el Policy
        $this->authorize('update', $profile);

        // Validar
        $data = request()->validate([
            'name' => 'required',
            'url' => 'required',
            'biography' => 'required'
        ]);

        // Si el usuario sube una imagen
        if( $request['image'] ) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['image']->store('upload-profiles', 'public');

            // Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600 );
            $img->save();

            // Crear un arreglo de imagen
            $array_imagen = ['image' => $ruta_imagen];
        } 

        // Asignar nombre y URL
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        // Eliminar url y name de $data
        unset($data['url']);
        unset($data['name']);


        // Guardar información
        // Asignar Biografia e imagen
        auth()->user()->profile()->update( array_merge(
            $data,
            $array_imagen ?? []
        ) );


        // redireccionar
        return redirect()->action([PostController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
