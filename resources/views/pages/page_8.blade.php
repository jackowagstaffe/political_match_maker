@extends('base')
@section('main-content')
	<h1>Environment</h1>
	<p>Do you agree or disagree with these things?</p>

    <form action="{{ route('submit_page', ['page_id' => $page_id]) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach($sets['environment'] as $policy)
            <div class="policy-question">
                <div class="pq-text">
                    {{ $policy->getTextNoHtml() }}
                </div>
                <div class="pq-buttons">
                    <div class="row">
                        <div class="col-sm-6 left-np">
                            <input type="radio" id="agree_{{ $policy->number }}" name="policy_{{ $policy->number }}" value="agree">
                            <label class="agree-label" for="agree_{{ $policy->number }}">
                                Agree
                            </label>
                        </div>
                        <div class="col-sm-6 right-np">
                            <input type="radio" id="disagree_{{ $policy->number }}" name="policy_{{ $policy->number }}" value="disagree">
                            <label class="disagree-label" for="disagree_{{ $policy->number }}">
                                Disagree
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="right-button-container">
            <button type="submit" class="btn btn-primary btn-lg">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </form>

@stop
