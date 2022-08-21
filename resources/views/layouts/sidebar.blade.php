<menu class="m-0">
    <div class="list-group">
        <a href="{{ route('home') }}" class="list-group-item">Home</a>
    </div>
    <div class="mt-3">
        <small class="text-black-50 font-weight-bolder">Manage Category</small>
        <div class="list-group">
            <a href="{{ route('category.create') }}" class="list-group-item">Create Category</a>
            <a href="{{ route('category.index') }}" class="list-group-item">Category List</a>
        </div>
    </div>
    <div class="mt-3">
        <small class="text-black-50 font-weight-bolder">Manage Post</small>
        <div class="list-group">
            <a href="{{ route('post.create') }}" class="list-group-item">Create Post</a>
            <a href="{{ route('category.index') }}" class="list-group-item">Post List</a>
        </div>
    </div>
</menu>