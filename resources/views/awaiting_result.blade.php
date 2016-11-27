@extends('base')
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="/js/result-loader.js"></script>
@stop
@section('main-content')
    <input type="hidden" id="data-url" value="{{ route('get_result') }}">
    <input type="hidden" id="data-hash" value="{{ $hash }}">
    <div id="wait">
	       <h1>Please wait while yout political match is generated</h1>
    </div>
    <div id="result" style="display: none">
        <h1>Your political match is <span id="mp-name"></span></h1>
    </div>
@stop
