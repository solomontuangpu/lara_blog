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
                    @notAuthor
                     <th>owner</th>
                    @endnotAuthor
                    <th>Total Posts</th>
                    <th>control</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>


               @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        @notAuthor
                        <td>
                            {{ $category->user->name }}
                         </td>
                         @endnotAuthor
                         <td>
                            {{ $category->posts()->count() }}
                        </td>
                        <td>
                            @can('update', $category)
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>                                
                            @endcan
                           @can('delete', $category)
                            <form action="{{ route('category.destroy', $category->id) }}" 
                                method="post"
                                class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                           @endcan
                        </td>
                        <td>
                            <span>
                                 <i class="bi bi-calendar-date"></i>
                                 {{ $category->created_at->format('M d, Y') }}
                            </span>
                             <br>
                             <span>
                                 <i class="bi bi-clock"></i>
                                 {{ $category->created_at->format('H : m') }}
                             </span>
                         </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
     </div>
</div>

@endsection
