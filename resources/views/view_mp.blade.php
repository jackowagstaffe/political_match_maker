@extends('base')
@section('main-content')
    <h1>{{ $mp->name }}</h1>

    @foreach($mp->getPolicies() as $no => $fact_group)
        <div class="row">
            <div class="col-md-4">
                {!! $policy_data->getTextFromNumber($no) !!}
            </div>

            <div class="col-md-6">
                @foreach($fact_group as $fact)
                    <p>
                        {{ $fact->getDreamMpType() }}
                         ::
                        {{ $fact->value }}
                    </p>
                @endforeach
            </div>
        </div>
    @endforeach
@stop
