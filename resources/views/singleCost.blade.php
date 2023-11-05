@extends('main-layout')
@section('title')
    Cost | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Ваш расход</div>
{{--        <div class="navbar-text">Легкий учет ваших финансов</div>--}}
    </nav>
    <div class="container">
        <br>
        <div class="alert alert-success">
            <div>Категория: {{ $cost->category->name }}</div>
            <div>Кошелек: {{ $cost->wallet->name }}</div>
            <div>Сумма: <b>{{ $cost->value }} руб.</b></div>
            <div>Дата: {{ $cost->created_at->format('d.m.Y') }}</div>
            <div>Комментарий: {{ $cost->comment }}</div>
        </div>

        <div class="row col-12">
            <div class="col-4">
                {!! Form::open(['url' => URL::route('costs'), 'class' => 'form']) !!}
                {{ Form::hidden('year', $year)  }}
                {{ Form::hidden('month', $month)  }}
                {{ Form::submit('Вернуться', ['class' => 'btn btn-primary btn-sm', 'data-type' => 'redirect']) }}
                {{ Form::close() }}

            </div>

            <div class="form-group col-4">
            <a class="btn btn-secondary btn-sm" href="{{ route('updateCost', [$cost->id, $year, $month]) }}">Изменить</a>
{{--                {!! Form::open(['url' => URL::route('updateCost', $cost->id, $year, $month), 'class' => 'form']) !!}--}}
{{--                {{ Form::hidden('year', $year)  }}--}}
{{--                {{ Form::hidden('month', $month)  }}--}}
{{--                {{ Form::submit('Изменить', ['class' => 'btn btn-secondary btn-sm', 'data-type' => 'redirect']) }}--}}
{{--                {{ Form::close() }}--}}

            </div>

            <div class="form-group col-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('deleted', $cost->id) }}" method="post">
                @csrf
                {{ Form::submit('Удалить', ['class' => 'btn btn-danger btn-sm']) }}
            </form>
            </div>
        </div>
    </div>
@endsection
