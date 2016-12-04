@extends('base')
@section('main-content')
	<h1>Welfare</h1>
	<p>Do you agree or disagree with the following?</p>

    <form action="{{ route('submit_page', ['page_id' => $page_id]) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach($sets['welfare'] as $policy)
            @include('components/policy-question', ['policy' => $policy])
        @endforeach

        <div class="right-button-container">
            <button type="submit" class="btn btn-primary btn-lg">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </form>

@stop
