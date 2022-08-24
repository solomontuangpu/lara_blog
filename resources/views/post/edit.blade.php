@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Edit Post</h4>
        <hr>
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        name="title" id="title"
                        value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" 
                        name="category" 
                        id="category">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category', $post->category_id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" 
                    class="form-control 
                    @error('description') is-invalid @enderror" 
                    name="description" 
                    id="description"
                    rows="10">
                    {{ old('description', $post->description) }}
                </textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    <label for="featureImage">Feature Image</label>
                    <input class="form-control @error('feature_image') is-invalid  @enderror" 
                            type="file" 
                            name="feature_image" 
                            id="featureImage">
                    @error('feature_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary">Update Post</button>
            </div>
            @isset($post->feature_image)
                <img src="{{ asset('storage/'.$post->feature_image) }}" class="w-25 my-3" alt="">
             @endisset
        </form>
    </div>
</div>


@endsection
