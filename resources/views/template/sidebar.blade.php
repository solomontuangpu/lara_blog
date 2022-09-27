<div class="my-3">
    <form action="" method="GET">
        <div class="input-group">
             <input type="search" name="keyword" id=""
                value="{{ request('keyword') }}"
                class="form-control">
             <button class="btn btn-secondary">Search</button>
        </div>
    </form>
</div>

<div class="mb-3">
    <h3>Category List</h3>
    <div class="list-group">
        <a href="{{ route("page.index") }}" 
            class="list-group-item {{ request()->url() === route('page.index') ? 'active' : '' }}">
            All Categories
        </a>
        @foreach ($categories as $key=>$category)
            <a class="list-group-item {{ request()->url() === route("page.category", $category->slug) ? 'active' : '' }}" 
                href="{{ route("page.category", $category->slug) }}">{{ $category->title }}
            </a>                    
        @endforeach
      
    </div>
</div>