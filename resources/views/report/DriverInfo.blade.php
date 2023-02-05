@extends('layouts.base')

@section('page.title','DriverInfo')

@section('content')
<h1>
    Driver Info about
</h1>

@foreach($drivers as $driver)
    @if ($driver['id'] == request('driverID'))
     <p style="font-size: 20px;"> {{$driver['id']}} | {{$driver['name']}} | {{$driver['score']}} | {{$driver['team']}}</p>
 @endif




@endforeach




@endsection
