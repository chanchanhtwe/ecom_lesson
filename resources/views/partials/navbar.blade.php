<nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top" id="navbg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else

                @if(Auth::User()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users')}}"><i class="fas fa-users"></i> Users</a>
                    </li>
                @endif
                @if(Auth::User()->hasAnyRole(['Admin']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('orders')}}"><i class="fas fa-first-order-alt"></i> Orders</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts')}}"><i class="fas fa-tags"></i> Posts</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('posts.categories')}}"><i class="fas fa-clipboard-list"></i> Categories</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           <i class="fas fa-user-alt"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
