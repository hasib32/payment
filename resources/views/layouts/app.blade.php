<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medical-Payment</title>

    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Medical Payment</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Search Medical Payment Data By</h2>
        <br>

        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a data-toggle="tab" href="#">Physician</a></li>
            <li role="presentation"><a href="#">Company Making Payment</a></li>
            <li role="presentation"><a href="#">Teaching Hospital</a></li>
        </ul>
        @yield('content')
    </div><!-- /.container -->
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>
