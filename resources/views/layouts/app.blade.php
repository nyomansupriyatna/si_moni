<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel 8') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/sn.js') }}"></script>
        <script src="{{ asset('js/jquery_351.js') }}"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>

        <style>
            /* Tooltip container */
            .tooltip {
              position: relative;
              display: inline-block;
              border-bottom: 0px; /* If you want dots under the hoverable text */
            }

            /* Tooltip text */
            .tooltip .tooltiptext {
                display:block;
                visibility: hidden;
                width: 80px;
                background-color: white;
                color: gray;
                text-align: center;
                padding: 3px 0;
                border-radius: 10px;
                font-size: 12px;

                bottom: 100%;
                left: 50%;
                margin-left: -40px; /* Use half of the width (120/2 = 60), to center the tooltip */

                /* Position the tooltip text - see examples below! */
                position: absolute;
                z-index: 1;
            }

            /* Show the tooltip text when you mouse over the tooltip container */
            .tooltip:hover .tooltiptext {
                transition-delay: 2s;
                visibility: visible;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50">
            <main class="relative flex flex-col min-h-screen mt-16 sm:flex-row" >
                @livewire('sidebar')
                <div class="flex flex-col flex-1">
                    @include('livewire.inc.header')
                    {{ $slot }}
                    @livewire('footer')
                </div>
            </main>
            @livewire('navbar')

        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    
        <script src="{{ asset('js/jquery331.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
   
    </body>
</html>

