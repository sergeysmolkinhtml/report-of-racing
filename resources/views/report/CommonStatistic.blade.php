@extends('layouts.base')

@section('page.title','Common Statistic')

@section('content')

    <h1>Common Statistic</h1>

    @foreach($drivers as $key=>$driver)
        <div class="container">
           <pre>
           <tr>{{$key+1}} <td>{{$driver['name']}}</td>
           <td>{{$driver['team']}}</td>
           <td>{{$driver['score']}}</td></tr></pre>
        </div>
    @endforeach

@endsection
