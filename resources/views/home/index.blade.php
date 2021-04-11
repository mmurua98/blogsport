@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" action={{ route('search.show') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Find a post!</p>

                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Search"
                    />
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Latest posts</h2>

        <div class="owl-carousel owl-theme">
            @foreach ($latest as $new)
                <div class="card ">
                    <img src="/storage/{{ $new->image }} " class="card-img-top" alt="imagen receta">

                    <div class="card-body h-100">
                        <h3>{{ Str::title( $new->title ) }}</h3>

                        <p> {{ Str::words(  strip_tags( $new->content ), 15 ) }} </p>

                        <a href=" {{ route('posts.show', ['post' => $new->id ]) }} "
                            class="btn btn-primary d-block font-weight-bold text-uppercase"
                        >View Post</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas más Votadas</h2>
        
        <div class="row">
            @foreach($liked as $like)
                @include('ui.post')
            @endforeach
        </div>
    </div> --}}

    @foreach($posts as $key => $grupo )
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-', ' ',  $key) }} </h2>
            
            <div class="row">
                @foreach($grupo as $posts)
                    @foreach($posts as $post)
                        @include('ui.post')
                    @endforeach
                @endforeach
            </div>
        </div>

    @endforeach

@endsection