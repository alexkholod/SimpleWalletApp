<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#24cda5">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="message-container bg-success {{ Session::has('success') ? 'active' : '' }}">
    @if (Session::has('success'))
        <div>{!! Session::get('success') !!}</div>
    @endif
    <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="container">
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-light" style="background-color: #25CDA5; align-content: center; z-index:999;">
            <a class="navbar-brand col-2" href="{{ route('home') }}"><img src="http://sw.running-life.ru/home_icon.png" alt="home"></a>
            <a class="navbar-brand col-2" href="{{ route('costs') }}"><img src="http://sw.running-life.ru/list_icon.png" alt="costs"></a>
            <a class="navbar-brand col-2" href="{{ route('settings') }}"><img src="http://sw.running-life.ru/settings_icon.png" alt="settings"></a>
            <a class="navbar-brand col-2" href="{{ route('add-cost') }}"><img src="http://sw.running-life.ru/add_icon.png" alt="add"></a>
{{--            <a class="navbar-text col-2">Home</a>--}}
{{--            <a class="navbar-text col-2">Costs</a>--}}
{{--            <a class="navbar-text col-2">Settings</a>--}}
{{--            <a class="navbar-text col-2">Add</a>--}}
        </nav>
</div>

@yield('main-content')

@yield('footer')

</body>
</html>
