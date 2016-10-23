@extends('base')
@section('main-content')
    <h1>MPs</h1>

    <p>Select MPs from the list below</p>

    @foreach($mps as $mp)
        @include('components/mp-button', ['mp' => $mp])
    @endforeach
@stop
