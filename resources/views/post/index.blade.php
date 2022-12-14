@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Post List</li>
            </ol>
        </nav>
    </div>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <p class="mb-0">
        @if(request('keyword'))
          Search result of: <b> "{{ request('keyword') }}"</b>
          <a class="btn btn-sm" href="{{ route('post.index') }}">
             <i class="bi bi-trash"></i>
          </a>
        @endif
    </p>
    <form action="{{ route('post.index') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Search">
            <button class="btn btn-secondary">
                <i class="bi bi-search"></i>
                Search
            </button>
        </div>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="w-25">title</th>
                    <th>category</th>
                  @notAuthor
                        <th>owner</th>
                    @endnotAuthor
                    <th colspan="2">control</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{$post->category->title }}</td>
                    
                       @notAuthor
                             <td>{{ $post->user->name }} </td>
                        @endnotAuthor

                        <td colspan="2">
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            @can('update', $post)
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('delete', $post)
                               @trash
                                <form action="{{ route('post.destroy', [$post->id, "delete" => "force"]) }}" 
                                    method="post"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>

                                <form action="{{ route('post.destroy', [$post->id, "delete"=>"restore"]) }}" 
                                    method="post"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-recycle"></i>
                                    </button>
                                </form>
                               @else
                                <form action="{{ route('post.destroy', [$post->id, "delete" => "soft"]) }}" 
                                    method="post"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                               @endtrash
                            @endcan
                        </td>
                        <td>
                                {!! $post->time !!}
                        </td>
                    </tr>
                @empty
                   <tr>
                     <td colspan="7" class=" text-center">
                        <h3>There is no post yet!!!</h3>
                     </td>
                   </tr>
                @endforelse

            </tbody>
        </table>

        {{ $posts->onEachSide(1)->links() }}

     </div>
</div>

@endsection
