<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">Blog Post</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav nav-pills ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <x-nav-link name="Home" :url="route('page.index')" />
          </li>
       
          @guest
            <li class="nav-item">
              <x-nav-link name="Register" :url="route('register')" />
            </li>
            <li class="nav-item">
              <x-nav-link name="Login" :url="route('login')" />
            </li>
          @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
          @endguest
        
        </ul>
      </div>
    </div>
  </nav>