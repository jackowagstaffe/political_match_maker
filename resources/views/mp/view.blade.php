@extends('base')
@section('main-content')
    <a href="{{ route('index_mp') }}">
        <div class="back-bar bg-primary">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Return to list
        </div>
    </a>
    <h1>{{ $mp->name }}</h1>

    @foreach($mp->getPolicies() as $policy_position)
        @include('components/policy-view', ['policy_position' => $policy_position])
    @endforeach
@stop
