@extends('base')
@section('main-content')
	<h1>Welfare</h1>
	<p>Do you agree or disagree with the follwing</p>

	@include('components/policy_form', [])
@stop
