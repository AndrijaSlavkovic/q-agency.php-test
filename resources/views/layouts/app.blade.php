<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        <div>
            @if(Session::has('error'))
                <div style="background-color: red;">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if(Session::has('success'))
                <div style="background-color: green;">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div>
            <nav>
                <a href="{{ route('authors') }}">Authors</a>
                <a href="{{ route('book.show') }}">Add New Book</a>
                <a href="{{ route('logout') }}">Logout</a>
            </nav>
            @session('user')
                <span style="position: absolute; top: 5px; right: 5px;">Welcome {{ session('user')['user']['first_name'] }} {{ session('user')['user']['last_name'] }}!</span>
            @endsession
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>