@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category List</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>owner</th>
                    <th>control</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->user_id }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('category.destroy', $category->id) }}" 
                                method="post"
                                class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            {{ $category->created_at->format('M d, Y') }}
                            <br>
                            {{ $category->created_at->format('H : m') }}
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
     </div>
</div>

@endsection
