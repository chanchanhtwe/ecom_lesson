<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel lesson @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('bst/js/jquery.js') }}"></script>
    <script src="{{ asset('bst/js/popper.js') }}"></script>
    <script src="{{ asset('bst/js/bootstrap.js') }}"></script>
    <script>
        $(function () {
            setTimeout(function () {
                $('.myAlert').fadeOut();
            },3000)

            $('[data-toggle="tooltip"]').tooltip()

            $("#filter_by_date").on('change',function () {
                $("#form_filter_by_date").submit();
            })

            $("#filter_by_month").on('change',function () {
                $("#form_filter_by_month").submit();
            })

        })
    </script>

    <!-- Fonts -->
    <link href="{{ asset('fa/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bst/css/bootstrap.css') }}" rel="stylesheet">
    <style>
        .myAlert{
            position: absolute;
            top:80px;
            right:20px;
        }
        #navbg{
            background:#109bec;
        }
        #orderInfo{
            color: #8c8eff;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('partials.navbar')

            @yield('content')
    </div>
    @if(Session('info'))
        <div class="alert alert-success myAlert">
            {{ Session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</body>
</html>
