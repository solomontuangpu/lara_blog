@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">User List</li>
            </ol>
        </nav>
    </div>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <p class="mb-0">
        @if(request('keyword'))
          Search result of: <b> "{{ request('keyword') }}"</b>
          <a class="btn btn-sm" href="{{ route('user.index') }}">
             <i class="bi bi-trash"></i>
          </a>
        @endif
    </p>
    <form action="{{ route('user.index') }}" method="get">
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
                    <th>name</th>
                    <th>email</th>
                    <th>role</th>
                    <th colspan="2">control</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td colspan="2">
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            @can('update', $user)
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('delete', $user)
                                <form action="{{ route('user.destroy', $user->id) }}" 
                                    method="user"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-secondary">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                        <td>
                        <span>
                                <i class="bi bi-calendar-date"></i>
                                {{ $user->created_at->format('M d, Y') }}
                        </span>
                            <br>
                            <span>
                                <i class="bi bi-clock"></i>
                                {{ $user->created_at->format('H : m') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    
                @endforelse

            </tbody>
        </table>

        {{ $users->onEachSide(1)->links() }}

     </div>
</div>

@endsection
