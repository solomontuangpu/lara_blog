@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <x-breadcrumb :links="$links" />
    </div>
</div>
{{-- <div class="card">
    <div class="card-body">
        <h4>Create Post</h4>
        <hr>
      
    </div>
</div> --}}

<x-card>
    <x-slot:title>Create Post</x-slot:title>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-input name="title" label="Title" />

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select @error('category') is-invalid @enderror" 
                    name="category" 
                    id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected' : '' }}>
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

        <x-input name="photos" type="file" label="Post Photos" />
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" 
                class="form-control 
                @error('description') is-invalid @enderror" 
                name="description" 
                id="description"
                rows="10">
                {{ old('description') }}
            </textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center">

            <x-input name="feature_image" type="file" label="Feature Image" />

            <button class="btn btn-primary">Create Post</button>
        </div>
      
    </form>
</x-card>


@endsection
