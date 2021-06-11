<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials._head')
</head>

<body>
    <style>
        * {
            box-sizing: border-box;
        }

        main {
            background: #000000;
            background: -webkit-linear-gradient(to right, #434343, #000000);
            background: linear-gradient(to right, #434343, #000000);
            color: #fff;
            padding: 20px 40px;
        }

    </style>
    
    <main class="vh-100">
        @include('partials._messages')
        @yield('content')
        <a class="btn btn-secondary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Çıxış <i class="fas fa-sign-out-alt fa-xs"></i>
        </a>
    
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </main>
    @include('partials._scripts')
</body>

</html>
