@extends('main-layout')
@section('title')
    Cost | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Редактирование</div>
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
            {!! Form::open(['url' => URL::route('updated', [$cost->id, $year, $month]), 'class' => 'form']) !!}
            @csrf
            <div class="form-group">
                <label for="wallets">Кошелек</label>
                {{ Form::select('wallets', $wallets, $cost->wallet->id, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="categories">Категория</label>
                {{ Form::select('categories', $categories, $cost->category->id, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="value">Сумма, руб.</label>
                {{ Form::text('value', $cost->value, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="value">Дата</label>
                {{ Form::date('date', $cost->created_at, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="comment">Комментарий</label>
                {{ Form::text('comment',$cost->comment, ['class' => 'form-control']) }}
            </div>

            <div class="row">
                <div class="col-4">
                    {{ Form::submit('Сохранить', ['class' => 'btn btn-success btn-sm', 'data-type' => 'redirect']) }}
                    {{ Form::close() }}
                </div>

                <div class="col-4">
                    {!! Form::open(['url' => URL::route('costs'), 'class' => 'form']) !!}
                    @csrf
                    {{ Form::hidden('year', $year)  }}
                    {{ Form::hidden('month', $month)  }}
                    {{ Form::submit('Вернуться', ['class' => 'btn btn-primary btn-sm', 'data-type' => 'redirect']) }}
                    {{ Form::close() }}
                </div>

                <div class="col-4">
                    {!! Form::open(['url' => URL::route('deleted', $cost->id), 'class' => 'form']) !!}
                    @csrf
                    {{ Form::submit('Удалить', ['class' => 'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
