<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>@yield('title')</title>
        <link href="{{ asset('semanticui/semantic.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <!-- <link href="{{ asset('semanticui/components/card.min.css') }}" media="all" rel="stylesheet" type="text/css" /> -->
        <link href="{{ asset('semanticui/components/menu.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/grid.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/button.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/form.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/checkbox.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/dropdown.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/icon.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/image.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('semanticui/components/input.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <!-- <link href="{{ asset('semanticui/components/dimmer.min.css') }}" media="all" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="{{ asset('semanticui/components/popup.min.css') }}" media="all" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="{{ asset('semanticui/components/modal.min.css') }}" media="all" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="{{ asset('semanticui/components/message.min.css') }}" media="all" rel="stylesheet" type="text/css" /> -->
        <link href="{{ asset('css/styles.css') }}" media="all" rel="stylesheet" type="text/css" />


        <script type="text/javascript" src="{{ asset('jquery-2.2.4.min.js') }}"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script src="{{ url('/') }}/design/js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


    </head>
    <body id="body">
        @yield('header')
        <div class="ui container main-container">
            <div class="ui grid main-grid">
                @yield('topper')
                @yield('sidebar')
                @yield('content')
            </div>
        </div>
        <footer class="ui vertical footer">
            <div class="ui center aligned container">
            </div>
        </footer>

        <!-- <script type="text/javascript" src="{{ asset('jquery-2.2.4.min.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('semanticui//semantic.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/form.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/checkbox.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('semanticui/components/dropdown.min.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ asset('semanticui/components/dimmer.min.js') }}"></script> -->
        <!-- <script type="text/javascript" src="{{ asset('semanticui/components/popup.min.js') }}"></script> -->
        <!-- <script type="text/javascript" src="{{ asset('semanticui/components/modal.min.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
        @stack('scripts')
    </body>
</html>