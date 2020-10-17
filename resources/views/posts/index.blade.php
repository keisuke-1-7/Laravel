@extends('posts.layouts')

@section('content')

    <div class="container mt-4">
        <div class="mb-4">
            <a href = "{{route('posts.create')}}" class="btn btn-primary">
                投稿を新規作成する
            </a>
        </div>
        
        @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-header mb-2">
                {{ $post->title }}
            </div>
            <div class="card-body">
                <p class="card-text">
                {{ $post->body }}
                </p>
            </div>
            <div class="card-footer">
                <span class="mr-2">
                    投稿日時
                </span>
            </div>
        </div>
        @endforeach
    </div>

@endsection('content')