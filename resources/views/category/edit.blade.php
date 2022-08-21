@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Create Category</h4>
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-inline">
                <input type="text" 
                        class="form-control w-50 d-inline-block @error('title') is-invalid @enderror"
                        name="title" 
                        value="{{ old('title', $category->title) }}">

                <button class="btn btn-primary">
                    Edit Category
                </button>
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </form>
    </div>
</div>


@endsection
