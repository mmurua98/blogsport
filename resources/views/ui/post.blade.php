<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{ $post->image }}" alt="imagen receta">
        <div class="card-body">
            <h3 class="card-title">{{$post->title}}</h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                    $date = $post->created_at
                @endphp

                <p class="text-primary fecha font-weight-bold">
                    <date-post date="{{$date}}" ></date-post>
                </p>

                <p> {{ count( $post->likes ) }} Liked it</p> 
            </div>

            <p> {{ Str::words(  strip_tags( $post->content ), 20, ' ...' ) }} </p>

            <a href="{{ route('posts.show', ['post' => $post->id ])}}"
                class="btn btn-primary d-block btn-receta">VIEW POST
            </a>
        </div>
    </div>
</div>