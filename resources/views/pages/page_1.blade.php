@extends('base')
@section('main-content')
	<h1>Welfare</h1>
	<p>which of these best describes you</p>
	@include('components/next-button', ['url' => route('page', ['page_id' => $page_id + 1])])
@stop