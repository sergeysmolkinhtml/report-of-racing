@extends('layouts.base')

@section('page.title','Main page')

@section('content')

    <h1>
        Главная страница
    </h1>

    <p><a href="{{ route('report.drivers') }}">Show common statistic</a></p>

    <p><a href="{{ route('report.drivers.show') }}">Shows list of drivers name and code</a></p>

    <p><a href="{{ route('report.drivers.sort','true') }}">Show route with order parameter</a></p>


@endsection
