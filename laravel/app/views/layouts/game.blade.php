<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    @include('layouts.parts.global.gameResources')
</head>
<body class="black-color brokingclub-color">
    @include('layouts.parts.game.topbar')

    <section id="main-container">
        @include('layouts.parts.game.leftNavigation')
        <section id="min-wrapper">
            <div id="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @include('partials.flashmessages')
                            <h3 class="ls-top-header">{{ $title }}</h3>
                             @include('layouts.parts.game.breadcrumbs')
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>

        </section>
        @include('layouts.parts.game.rightWrapper')

    </section>


    @include('layouts.parts.game.beforeFooter')
</body>
</html>