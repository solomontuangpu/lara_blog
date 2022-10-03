@extends('layouts.app')

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <x-breadcrumb />
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>
            Hello World || @myname
            <br>
            <div>
                {!! QrCode::size(300)->style('round')->generate(request()->url()); !!}
            </div>
        </h4>
    </div>
</div>

@endsection
