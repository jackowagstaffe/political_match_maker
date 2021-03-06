<!DOCTYPE html>
<html>
    <head>
        <title>Political Match Maker</title>
        <link href="/css/app.css" rel="stylesheet" crossorigin="anonymous">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <nav class="navbar navbar-pink">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <i class="fa fa-heart" aria-hidden="true"></i> Political Match Maker
                    </a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="content">
                @section('main-content')
                    <p>Some content is in here</p>
                @show
            </div>
        </div>
        <div class="footer text-center">
            <p><a href="https://www.theyworkforyou.com/">Data service provided by TheyWorkForYou</a></p>
        </div>

        <script src="https://use.fontawesome.com/4c126a530b.js"></script>
        @yield('scripts')
    </body>
</html>
