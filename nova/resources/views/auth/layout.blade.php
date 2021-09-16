<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <!-- Custom Meta Data -->
    @include('nova::partials.meta')

    <!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
</head>
<body class="text-black h-full">
    <div class="h-full">
        <div class="back-rec">
            <div class="path-2719">
                <div class="left-rec">
                    <div class="rec-2212">
                    </div>
                    <div class="rec-2217">
                    </div>
                    <div class="rec-2218">
                    </div>
                    <div class="rec-2219">
                    </div>
                </div>
                <div class="right-rec">
                    <div class="rec-2216">
                    </div>
                    <div class="rec-2214">
                    </div>
                    <div class="rec-2213">
                    </div>
                    <div class="rec-2215">
                    </div>
                </div>
            </div>
        </div>

        <div class="px-view py-view padding-top-8 mx-auto h-main">
            @yield('content')
        </div>
    </div>
</body>
</html>
