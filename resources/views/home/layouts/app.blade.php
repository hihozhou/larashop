<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->


    <!-- Styles -->
    <link href="{{ elixir('css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
    </script>
</head>
<body>
<div id="app">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
{{--<script src="/js/app.js"></script>--}}
</body>
</html>
