@extends('layouts.app')

@section('botones')
    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Back
    </a>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($profile->image)
                 <img src="/storage/{{$profile->image}}" class="w-100 rounded-circle" alt="imagen chef">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h1 class="text-center mb-2 text-primary">{{$profile->user->name}}</h1>
                {{-- <h2><a href="{{$profile->user->url}}">Contact</a></h2> --}}
                <div class="biografia">
                        {!! $profile->biography !!}
                </div>
                <h4 class="text-center my-5"><a href="{{$profile->user->url}}" target="_blank">Contact</a></h4>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Posts created by: {{$profile->user->name }}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if( count($posts) > 0)
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{$post->image}}" class="card-img-top" alt="imagen receta">

                            <div class="card-body">
                                <h3>{{$post->title}}</h3>
                                <a href="{{ route('posts.show', ['post' => $post->id ]) }}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">VIEW POST</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center w-100">There are no posts yet...</p>
            @endif
            
   
        </div>
        <div class="d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>

@endsection