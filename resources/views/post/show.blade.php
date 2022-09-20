@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Post</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>{{ $post->title }}</h4>
        <div class="">
            <span>
                <i class="bi bi-person"></i>
                {{ $post->user->name }}
            </span>
            <br>
            <span>
                <i class="bi bi-calendar-date"></i>
                {{ $post->created_at->format('M d, Y-h:i') }}
            </span>
        </div>
        <hr class="m-2">
        <span>
            <p class="badge bg-secondary mb-0">{{ $post->category->title }}</p>
        </span>

       @isset($post->feature_image)
           <img class="w-100 my-3" src="{{ asset('storage/'.$post->feature_image) }}" alt="">
       @endisset

        <p>{{ $post->description }}</p>

       @foreach ($post->photos as $photo)
           <img src="{{ asset('storage/'.$photo->name) }}" height="100" alt="">
       @endforeach

        <div class="">
            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-secondary">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('post.destroy', $post->id) }}" 
                method="post"
                class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </div>
     </div>
</div>

@endsection
