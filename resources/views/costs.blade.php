@extends('main-layout')
@section('title')
    Costs | Simple Wallet App
@endsection

@section('main-content')
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25CDA5;">
        <div class="navbar-brand">Simple Wallet App | Расходы</div>
        {{--        <div class="navbar-text">Легкий учет ваших финансов</div>--}}
    </nav>

    <div class="container" style="margin-bottom: 80px">
        <br>
        <div class="form-group col-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif

                {!! Form::open(['url' => URL::route('costs'), 'class' => 'form']) !!}
                @csrf
                <div class="row">
                    <div class="col">
                        {{ Form::select('year', $year, (Request::old('month', $selectedYear) ?? $selectedYear), ['class' => 'form-control']) }}
                    </div>

                    <div class="col">
                        {{ Form::select('month', $month, (Request::old('month', $selectedMonth) ?? $selectedMonth), ['class' => 'form-control']) }}
                    </div>

                    <div class="col">
                        {{ Form::submit('Выбрать', ['class' => 'btn btn-success']) }}
                    </div>
                </div>
        </div>

        <div class="row alert alert-success">
            <div class="col-12"><b>Расходы за {{ $month[$selectedMonth] }} {{ $selectedYear }} года</b></div>
            <div class="col-7 ml-3">Врачи</div>
            <div class="col-4">{{ $costsPerMonthDoctors }} р.</div>

            <div class="col-7 ml-3">Мать и Дитя</div>
            <div class="col-4">{{ $costsPerMonthMom }} р.</div>

            <div class="col-7 ml-3">Аптека</div>
            <div class="col-4">{{ $costsPerMonthApteka }} р.</div>

            <div class="col-7 ml-3">Остальное</div>
            <div class="col-4">{{ $sum - ($costsPerMonthDoctors + $costsPerMonthMom + $costsPerMonthApteka) }} р.</div>

            <div class="col-7 ml-3"><b>Итого</b></div>
            <div class="col-4"><b>{{ $sum }} р.</b></div>
        </div>

        <div class="row alert alert-success">
            <div class="col-12"><b>По кошелькам</b></div>
            @foreach($costsByWallet as $key => $value)
                <div class="col-7 ml-3">{{ $key }}</div>
                <div class="col-4">{{ $value }} р.</div>
            @endforeach
        </div>
        <div class="row alert alert-success">
            <div class="col-6"><b>Категория</b></div>
            <div class="col-3"><b>VISA</b></div>
            <div class="col-3"><b>CASH</b></div>
            @foreach($costsByCategoryVisa as $key => $value)
                @foreach($costsByCategoryCash as $key2 => $value2)
                    @if ($value != 0)
                        @if ($key == $key2)
                            <div class="col-6">{{ $key }}</div>
                            <div class="col-3">{{ $value }} р.</div>
                            <div class="col-3">{{ $value2 }} р.</div>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </div>

        @foreach($data as $element)
            <a href="{{ route('updateCost', [$element->id, $selectedYear, $selectedMonth]) }}">

                <div class="row alert alert-success">
                    <div class="col-6">{{ $element->category->name }}</div>
                    <div class="col-3">{{ $element->wallet->name }}</div>
                    <div class="col-3"><b>{{ $element->value }}</b> р.</div>
                    <div class="col-4">{{ $element->created_at->format('d.m.Y') }}</div>
                    <div class="col-8">{{ $element->comment }}</div>
                </div>
        @endforeach
    </div>
@endsection
