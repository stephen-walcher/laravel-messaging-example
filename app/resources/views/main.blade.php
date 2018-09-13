<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Messenger Example Application</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
    <link href="/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="app" class="main-app">
        <header class="navbar navbar-expand-lg navbar-light bg-light">
            <h3 class="col-8">Messenger Example Application</h3>
            @yield('name')
        </header>

        @yield('body')
    </div>

    <script>
        window.echoConfig = {
            host: {!! json_encode(env('ECHO_HOST')) !!},
            port: {!! json_encode(env('ECHO_PORT')) !!}
        };
    </script>

    <!-- Scripts -->
    <script src="//localhost:{{ env('ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    @yield('js')
</body>
</html>
