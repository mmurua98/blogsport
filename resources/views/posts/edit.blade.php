@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection 

@section('botones')
    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Back
    </a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Edit Post</h2>


    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title Post</label>

                    <input type="text"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror "
                        id="title"
                        placeholder="Title post"
                        value="{{$post->title}}"
                    >

                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group">
                    <label for="category_id">Category</label>

                    <select
                        name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror "
                        id="category_id"
                    >
                        <option value="">-- Choose a category -</option>
                        @foreach ($categories as $category)
                            <option 
                                value="{{ $category->id }}" 
                                {{ $post->category_id == $category->id ? 'selected' : '' }} 
                            >{{$category->name}}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ $post->content }}">
                    <trix-editor 
                        class="form-control @error('content') is-invalid @enderror "
                        input="content"
                    ></trix-editor>

                    @error('content')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">Select an image</label>

                    <input 
                        id="image" 
                        type="file" 
                        class="form-control @error('image') is-invalid @enderror"
                        name="image"
                    >

                    <div class="mt-4">
                        <p>Current Image:</p>
                        <img src="/storage/{{$post->image}}" alt="" style="width: 300px">
                    </div>

                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update post" >
                </div>

            </form>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>
@endsection