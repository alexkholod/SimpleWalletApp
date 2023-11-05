@extends('main-layout')
@section('title')
    Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App</div>
        <div class="navbar-text">Легкий учет ваших финансов</div>
    </nav>
    <div class="container">
        <br>
        <div class="row alert alert-success">
            <div class="col-12">На этой неделе</div>
            <div class="col-7 ml-3">По карте</div>
            <div class="col-4">{{ $weekByCard }} руб.</div>
            <div class="col-7 ml-3">Наличными</div>
            <div class="col-4">{{ $weekByCash }} руб.</div>
            <div class="col-7 ml-3"><b>Всего</b></div>
            <div class="col-4"><b>{{ $week }}</b> руб.</div>
        </div>

        <div class="row alert alert-success">
            <div class="col-12">В этом месяце</div>
            <div class="col-7 ml-3">По карте</div>
            <div class="col-4">{{ $monthByCard }} руб.</div>
            <div class="col-7 ml-3">Наличными</div>
            <div class="col-4">{{ $monthByCash }} руб.</div>
            <div class="col-7 ml-3"><b>Всего</b></div>
            <div class="col-4"><b>{{ $month }}</b> руб.</div>
        </div>

        <div class="row alert alert-success">
            <div class="col-10"><p>ТОП-5 категорий расходов:</p></div>
            @foreach($costsByCategory as $key => $value)
                <div class="col-8">{{ $key }}</div>
                <div class="col-4">{{ $value }} руб.</div>
            @endforeach
        </div>

        <div class="row mr-auto ml-auto">
            <a class="btn btn-success btn-sl" href="{{ route('add-cost') }}">Добавить расход</a>
        </div>
    </div>
@endsection


