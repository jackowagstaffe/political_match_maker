@extends('base')
@section('main-content')
	<h1>Social Issues</h1>
	<p>Do you agree or disagree with these things?</p>

    <form action="{{ route('submit_page', ['page_id' => $page_id]) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach($sets['social'] as $policy)
            @include('components.policy-question')
        @endforeach

        <div class="right-button-container">
            <button type="submit" class="btn btn-primary btn-lg">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </form>

@stop
