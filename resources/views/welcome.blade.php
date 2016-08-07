@extends('base')
@section('main-content')
    <h1>Find the perfect MP for you</h1>
    <p class="lead">Poltical match maker will find the perfect MP for you using the they work for us database.</p>
    <p>Simply complete the questionnaire and the perfect MP will be found for you based on their voting record and your answers.</p>
    @include('components/next-button', 
        [
            'text' => 'Start', 
            'url' => route('page', ['page_id' => 1])
        ]
    )
@stop
