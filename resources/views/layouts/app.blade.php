<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    Google access --}}
    <meta name="google-site-verification" content="-RQMcA0x6IpQbdiEat3uigKmvoJ-PY23XyytvWqE65c" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/06c02d4b68.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav style="height: 80px" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/news') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @auth()
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                <a class="nav-link" href="{{ route('admin::news') }}">{{ __('menu.admin') }}</a>
                            @endif
                        @endauth
                        <a class="nav-link" href="{{ route('news::categories') }}">{{ __('menu.categories') }} ({{ \App\Models\NewsCategories::count() }})</a>
                        <a class="nav-link" href="{{ route('news::news') }}">{{ __('menu.news') }} ({{ \App\Models\News::count() }})</a>
                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">
                        <li style="display: flex; flex-direction: column; justify-content: center" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('menu.lang') .'  '. mb_strtoupper(App::getLocale()) }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('locale',['lang' => 'ru']) }}">
                                    ru
                                </a>
                                <a class="dropdown-item" href="{{ route('locale', ['lang' => 'en'])}}">
                                    en
                                </a>
                            </div>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('menu.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('menu.register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    <img style="width: 40px; border-radius: 15px" src="{{ Auth::user()->avatar }}" alt="">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('menu.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @auth()
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                            <hr>
                                            <a class="dropdown-item" href="{{ route('admin::news') }}">{{ __('menu.news') }}</a>
                                            <a class="dropdown-item" href="{{ route('admin::user') }}">{{ __('menu.users') }}</a>
                                        @endif
                                    @endauth

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
