<menu class="m-0 p-0">
    <div class="list-group">
        <a href="{{ route('home') }}" class="list-group-item">Home</a>
        <a href="{{ route('photo.index') }}" class="list-group-item">Gallery</a>
    </div>
    <div class="mt-3">
        <small class="text-black-50 font-weight-bolder">Manage Category</small>
        <div class="list-group">
            <a href="{{ route('category.index') }}" class="list-group-item">Category List</a>
            <a href="{{ route('category.create') }}" class="list-group-item">Create Category</a>
        </div>
    </div>
    <div class="mt-3">
        <small class="text-black-50 font-weight-bolder">Manage Post</small>
        <div class="list-group">
            <a href="{{ route('post.index') }}" class="list-group-item">Post List</a>
            <a href="{{ route('post.create') }}" class="list-group-item">Create Post</a>    
        </div>
    </div>
    @admin

    <div class="mt-3">
        <small class="text-black-50 font-weight-bolder">Manage User</small>
        <div class="list-group">
            <a href="{{ route('user.index') }}" class="list-group-item">User List</a>
            
        </div>
    </div>

    @endadmin
</menu>