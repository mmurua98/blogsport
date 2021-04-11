@extends('layouts.app')

@section('botones')
    @include('ui.navigation')
@endsection

@section('content')
    <h2 class="text-center mb-5">Manage your posts</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Title</th>
                    <th scole="col">Category</th>
                    <th scole="col">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <td> {{$post->title}} </td>
                        <td> {{$post->category->name}} </td>
                        <td>

                            <delete-post
                                post-id={{$post->id}}
                            ></delete-post>

                            <a href="{{ route('posts.edit', ['post' => $post->id]) }} " class="btn btn-dark d-block mb-2">Edit</a>
                            <a href="{{ route('posts.show', ['post' => $post->id]) }} " class="btn btn-success d-block">View</a>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $posts->links() }}
        </div>


        <h2 class="text-center my-5">Posts you've liked</h2>
        <div class="col-md-10 mx-auto bg-white p-3">

            @if ( count( $user->meGusta ) > 0 )
                <ul class="list-group">
                    @foreach( $user->meGusta as $post )
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p> {{$post->title}}</p>

                            <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{ route('posts.show', ['post' => $post->id ])}}">GO</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center">You don't have any saved posts yet
                    <small> Like posts and they will appear here</small>
                </p>

            @endif
        </div>

    </div>

@endsection
