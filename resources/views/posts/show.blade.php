@extends ('layouts.app')



@section('content')

    {{-- <h1>{{ $receta}}</h1> --}}

    <article class="contenido-receta bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{$post->title}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Category:</span>
                <a class="text-dark" href="{{ route('categories.show', ['category' => $post->category->id ]) }} ">
                    {{$post->category->name}}
                </a>

            </p>

            <p>
                <span class="font-weight-bold text-primary">Author:</span>
                <a class="text-dark" href="{{ route('profiles.show', ['profile' => $post->author->id ]) }} ">
                    {{$post->author->name}}
                </a>

            </p>

            <p>
                <span class="font-weight-bold text-primary">Date: </span>
                {{-- {{$post->created_at}} --}}
                @php
                    $fecha = $post->created_at
                @endphp

                <date-post date="{{$fecha}}" ></fecha-receta>
            </p>



            <div class="ingredientes">
                {{-- <h2 class="my-3 text-primary">Content</h2> --}}

                <h4>{!! $post->content !!}</h4>
            </div>

            <div class="justify-content-center row text-center">
                <like-button
                    post-id="{{$post->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}"
                ></like-button>
            </div>




        </div>
    </article>
@endsection
