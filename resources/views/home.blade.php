@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <h4>Hello World</h4>
        <br>
        {{ Auth::user() }}
    </div>
</div>

@endsection
