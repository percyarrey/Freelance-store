<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="" href="{{ asset('asset/logo/favicon.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        {{-- @livewireStyles --}}
        <!-- font awesome style -->
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
        <style>
            .navbar-brand span {
            font-weight: bold;
            font-size: 30px;
            color: #198754;
            font-family:Arial, Helvetica, sans-serif;
            }
        </style>
    </head>

    <body>
        @if(request()->is('user/profile'))
        <header class="w-full flex container-lg" style="height: 40px;z-index;30;">
            <div class="fixed px-1 lg:px-5 bg-slate-100 shadow-sm w-full" style="z-index:30;">
            <nav class="navbar flex justify-between py-2 ps-3" >
                <a class="navbar-brand flex" href="/"><img width="30" src="{{asset('asset/logo/favicon.png')}}" alt="logo" /><span class="mt-1 fs-2 text-success d-none d-sm-block">Freelance Store</span></a>

                <div class=" items-center flex underline text-slate-600">
                    <a style="font-family: monseret" class=" text-[1.2rem] flex" href="/">Return home</a>
                </div>
            </nav>
            </div>
        </header>
        @endif
        




        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts

    </body>
</html>
