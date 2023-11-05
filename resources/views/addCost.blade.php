@extends('main-layout')
@section('title')
    Add Cost | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Ввод расхода</div>
{{--        <div class="navbar-text">Легкий учет ваших финансов</div>--}}
    </nav>
    <div class="container">
        <br>
        <div class="form-group col-10">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('added') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="wallets">Кошелек</label>
                {{ Form::select('wallets', $wallets, 1, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="categories">Категория</label>
                {{ Form::select('categories', $categories, 1, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="value">Сумма, руб.</label>
                {{ Form::text('value','', ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="value">Дата</label>
                {{ Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="comment">Комментарий</label>
                {{ Form::text('comment','', ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Сохранить', ['class' => 'btn btn-success btn-sl']) }}
            </div>
            </form>
        </div>
    </div>
@endsection
