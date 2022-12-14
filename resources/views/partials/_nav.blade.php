<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Laravel Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('/') ? "active" : "" }}">
          <a class="nav-link" href="/">Home </a>
        </li>
        <li class="nav-item {{ Request::is('blog') ? "active" : "" }}">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item {{ Request::is('about') ? "active" : "" }}">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item {{ Request::is('contact') ? "active" : "" }}">
            <a class="nav-link" href="/contact">Contact</a>
          </li>
          
      </ul>
       <!-- Right Side Of Navbar -->
       <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                   Hello  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('posts.index')}}">Posts</a>
                  <a class="dropdown-item" href="{{route('categories.index')}}">Categories</a>
                  <a class="dropdown-item" href="{{route('tags.index')}}">Tags</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
    <!--
    <ul class="navbar-nav ">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{route('posts.index')}}">Posts</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <hr>
          <a class="dropdown-item" href="#">Log Out</a>
        </div>
      </li>
    </ul>
  -->
    </div>
  </nav>