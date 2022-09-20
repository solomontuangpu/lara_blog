@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="gallery">
            @forelse (Auth::user()->photos as $photo)
                 <img src="{{ asset('storage/'.$photo->name) }}" alt=""
                 class="rounded w-100 mb-3">
            @empty
                <p>There is no uploaded photo!!!</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
