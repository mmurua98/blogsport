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
    {{-- {{$perfil->usuario }} --}}

    <h1 class="text-center">Edit my profile</h1>

   <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form
                action="{{ route('profiles.update', ['profile' => $profile->id ]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>

                    <input type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror "
                        id="name"
                        placeholder="Your name"
                        value="{{ $profile->user->name }}"
                    >

                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Web site</label>

                    <input type="text"
                        name="url"
                        class="form-control @error('url') is-invalid @enderror "
                        id="url"
                        placeholder="Your website"
                        value="{{ $profile->user->url }}"
                    >

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biography">Biography</label>
                    <input id="biography" type="hidden" name="biography"  value="{{ $profile->biography }}" >
                    <trix-editor 
                        class="form-control @error('biography') is-invalid @enderror "
                        input="biography"
                    ></trix-editor>

                    @error('biography')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">Your Image</label>

                    <input 
                        id="image" 
                        type="file" 
                        class="form-control @error('image') is-invalid @enderror"
                        name="image"
                    >

                    @if( $profile->image )
                        <div class="mt-4">
                            <p>Current Image:</p>
                            <img src="/storage/{{$profile->image}}" style="width: 300px">
                        </div>

                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update" >
                </div>

            </form>
        </div>
   </div>


@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>
@endsection