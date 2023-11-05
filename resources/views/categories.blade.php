@extends('main-layout')
@section('title')
    Costs | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Категории</div>
{{--        <div class="navbar-text">Легкий учет ваших финансов</div>--}}
    </nav>
    <div class="container">
    <br>
        <p><i>Редактирование и добавление категорий расходов подъедет в следующей версии</i></p>
            @foreach($data as $element)
{{--                <a href="{{ route('single', $element->id) }}">--}}
                <div class="row alert alert-success">
                    <div class="col-4"><b>{{ $element->name }}</b></div>
                    <div class="col-8">{{ $element->description }}</div>
                </div>
                </a>
            @endforeach
        <div class="col-4">
            <a class="btn btn-primary btn-sm" href="{{ route('settings') }}">Вернуться</a>
        </div>
    </div>
@endsection
