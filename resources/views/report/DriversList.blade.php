@extends('layouts.base')

@section('page.title','Driver List')

@section('content')

    <h1>Drivers List</h1>

    @foreach($drivers as $key=>$driver)
        <div class="container">
            <td>
                <a href="{{route('report.drivers.retrieve',$driver['id'])}}">{{$driver['id']}}</a>
                {{$driver['name']}}
            </td>
        </div>
    @endforeach

@endsection
