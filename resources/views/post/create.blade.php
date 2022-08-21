@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="" class="list-group-item">Home</a>
            </div>

           <div class="mt-3">
                <small class="text-black-50 font-weight-bolder">Manage Category</small>
                <div class="list-group">
                    <a href="" class="list-group-item">Create Category</a>
                    <a href="" class="list-group-item">Category List</a>
                </div>
           </div>

           <div class="mt-3">
            <small class="text-black-50 font-weight-bolder">Manage Post</small>
            <div class="list-group">
                <a href="" class="list-group-item">Create Post</a>
                <a href="" class="list-group-item">Post List</a>
            </div>
       </div>

        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h4>Hello World</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
