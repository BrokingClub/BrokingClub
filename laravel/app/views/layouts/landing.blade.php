<html>
    <head>
        <title>{{ $headTitle }}</title>
    </head>
    <body>
        <h1>{{ $title }}</h1>
        @include('partials.flashmessages')
        Hello
        @yield('content')
    </body>

</html>