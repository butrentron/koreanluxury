<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{!! isset($setting) && $setting->title ? $setting->title : 'Luxury - Thời trang Hàn Quốc' !!}</title>
    <meta name="keywords" content="{!! isset($setting) ? $setting->keyword : 'Thời trang Hàn Quốc' !!}">
    <meta name="description" content="{!! isset($setting) ? $setting->description : 'Thời trang Hàn Quốc' !!}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .a-menu {
            background: transparent;
        }
    </style>
</head>
<body id="app-layout">
    @include('site.partials.nav')

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
