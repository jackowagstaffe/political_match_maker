@extends('base')
@section('main-content')
    @if($page_data == 'foreignpolicy')
        <h1>Foreign Policy</h1>
    @else
        <h1>{{ ucfirst($page_data) }}</h1>
    @endif

	<p>Do you agree or disagree with the following?</p>

    <form action="{{ route('submit_page', ['page_id' => $page_id]) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach($sets[$page_data] as $policy)
            @include('components/policy-question', ['policy' => $policy])
        @endforeach

        @if($page_id > 1)
            <button type="submit"
                class="btn btn-lg"
                name="back"
                value="true">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
            </button>
        @endif
        <div class="right-button-container">
            <button type="submit" class="btn btn-primary btn-lg">
                Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </button>
        </div>
    </form>

@stop
