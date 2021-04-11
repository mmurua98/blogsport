@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Category: {{ $category->name }}
        </h2>

        <div class="row">
            @foreach ($posts as $post)
                @include('ui.post')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $posts->links() }}
        </div>
    </div>

@endsection