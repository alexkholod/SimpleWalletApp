@extends('main-layout')

@section('title')
    Settings | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Настройки</div>
{{--        <div class="navbar-text">Легкий учет ваших финансов</div>--}}
    </nav>
    <div class="container">
            <br>
            <p><i>Полный функционал этого раздела подъедет в следующей версии</i></p>
            <div class="row alert alert-success">
                <div class="col-10">Профиль</div>
            </div>

            <a href="{{ route('wallets') }}">
            <div class="row alert alert-success">
                <div class="col-10">Кошельки</div>
            </div>
            </a>

            <a href="{{ route('categories') }}">
            <div class="row alert alert-success">
                <div class="col-10">Категории расходов</div>
            </div>
            </a>

        <div class="row alert alert-success">
            <div class="col-10">Источники доходов</div>
        </div>

        <div class="row alert alert-success">
            <div class="col-10">О программе</div>
        </div>

        @auth('web')
        <div class="row alert alert-success">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Выйти') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @endauth
    </div>
@endsection
