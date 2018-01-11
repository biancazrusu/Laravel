<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>@yield('title')</title>
        <link href="{{ asset('semanticui/semantic.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/menu.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/grid.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/button.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/form.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/checkbox.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/dropdown.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/icon.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/image.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/input.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/styles.css') }}" media="all" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="{{ asset('jquery-2.2.4.min.js') }}"></script>
    </head>
    <body id="body">
        @yield('header')
        @yield('content')

        <script type="text/javascript" src="{{ asset('semanticui//semantic.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/form.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/checkbox.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/dropdown.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
        @stack('scripts')
    </body>
</html>