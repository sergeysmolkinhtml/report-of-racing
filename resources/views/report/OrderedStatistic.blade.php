@extends('layouts.base')

@section('page.title','Ordered Stats')

@section('content')
    <h1>Ordered Statistic about drivers</h1>

    ordered {{request('sort')}}
    @foreach($drivers as $key=>$driver)
        <div class="container">
           <pre>
           <tr> {{$key+1}} <td>{{$driver['name']}}</td>
           <td>{{$driver['team']}}</td>
           <td>{{$driver['score']}}</td></tr></pre>
        </div>
    @endforeach

@endsection
