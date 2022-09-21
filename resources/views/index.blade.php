@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="">
                    <form action="" method="GET">
                        <div class="input-group">
                             <input type="search" name="keyword" id=""
                                value="{{ request('keyword') }}"
                                class="form-control">
                             <button class="btn btn-secondary">Search</button>
                        </div>
                    </form>
                </div>

                <div class="mt-3">

                    @isset($category)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Filter By : {{ $category->title }}</p>
                            <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
                        </div>
                    @endisset
                </div>


                @forelse ($posts as $post)
                    <div class="card mt-3">
                        <div class="card-body">
                            <h3 class="mb-0">{{ $post->title }}</h3>
                            <div class="">
                                <a href="{{ route('page.category',  $post->category->slug) }}" class="">
                                    <span class="badge bg-secondary">
                                        {{ $post->category->title }}
                                    </span>
                                </a>
                            </div>
                            <p class="text-black-50 my-3">{{ $post->excerpt }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p class="mb-0">
                                        <i class="bi bi-person"></i>
                                        {{ $post->user->name }}
                                    </p>
                                    <p class="mb-0">{{ $post->created_at->diffforHumans() }}</p>
                                </div>
                                <a href="{{ route('page.detail', $post->slug) }}" class="btn btn-primary">See More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    Hello People! Welcome to my blog!!!!
                @endforelse

                    <div class="mt-3">
                        {{ $posts->onEachSide(1)->links() }}
                    </div>

            </div>
        </div>
    </div>    
@endsection
