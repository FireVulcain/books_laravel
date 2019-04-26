<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.menu')
            </div>
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="{{asset('js/app.js')}}"></script>
    @show
</body>
</html>