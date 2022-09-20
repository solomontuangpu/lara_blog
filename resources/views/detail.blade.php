@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">            
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="mb-0">{{ $post->title }}</h3>
                                <div class="">
                                    <a href="" class="">
                                        <span class="badge bg-secondary">
                                            {{ $post->category->title }}
                                        </span>
                                    </a>
                                </div>
                                @foreach ($post->photos as $photo)
                                    <img src="{{ asset('storage/'.$photo->name) }}" height="100" alt="" class="mt-3 me-3">
                                 @endforeach
                            </div>

                         

                            <p class="text-black-50 my-3">{{ $post->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p class="mb-0">
                                        <i class="bi bi-person"></i>
                                        {{ $post->user->name }}
                                    </p>
                                    <p class="mb-0">{{ $post->created_at->diffforHumans() }}</p>
                                </div>
                                <a href="{{ route('page.index') }}" class="btn btn-primary">All Posts</a>
                            </div>
                        </div>
                    </div>
             
            </div>
        </div>
    </div>    
@endsection
