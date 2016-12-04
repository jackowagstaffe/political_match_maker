@extends('base')
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js" integrity="sha256-1O3BtOwnPyyRzOszK6P+gqaRoXHV6JXj8HkjZmPYhCI=" crossorigin="anonymous"></script>
    <script src="/js/result-loader.js"></script>
@stop
@section('main-content')
    <input type="hidden" id="data-url" value="{{ route('get_result') }}">
    <input type="hidden" id="data-hash" value="{{ $hash }}">
    <div id="wait" class="text-center">
	       <h1>Please wait while your political match is generated</h1>
           <i class="fa fa-heart fa-spin fa-3x fa-fw brand-color"></i>
           <span class="sr-only">Loading...</span>
    </div>
    <div id="result" style="display: none">
        <h1>Your political match is <span id="mp-name"></span></h1>
        <p>Below is an outline of their policies</p>
        <div id="policies"></div>
    </div>

    <script id="policy-template" type="text/x-handlebars-template">
        <div class="policy">
            <p class="text-center policy-name">@{{{ policy_name }}}</p>
            <h2 class="text-center policy-text">@{{ policy_text }}</h2>
            <div class="agreement-bar">
                <span class="bar-text-right bar-text">agrees</span>
                <div class="disagreement">
                    <span class="bar-text">disagrees</span>
                    <div class="disagreement-grey" style="width: @{{ disagreement_width }}%">
                    </div>
                </div><div class="agreement" style="width: @{{ agreement_width }}%"></div>
            </div>
        </div>
    </script>
@stop
