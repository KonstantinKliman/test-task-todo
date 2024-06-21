<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo's</title>
    <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/libs/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/libs/jquery-3.7.1.min.js') }}"></script>
</head>
<body>
    <div class="layout">
        <header class="header">
            @include('components.header')
        </header>
        <main class="main">
            <div class="container-fluid h-100">
                @yield('main')
            </div>
        </main>
        <footer class="footer bg-body-secondary d-flex">
            @include('components.footer')
        </footer>
        <div id="authScript">
            <script src="{{ asset('/assets/js/auth.js') }}"></script>
        </div>
    </div>
</body>
</html>
