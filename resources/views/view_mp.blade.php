@extends('base')
@section('main-content')
    <h1>{{ $mp->name }}</h1>

    @foreach($mp->getPolicies() as $policy_position)
        @include('components/policy-view', ['policy_position' => $policy_position])
    @endforeach
@stop
