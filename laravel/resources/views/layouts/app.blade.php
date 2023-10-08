<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (isset($add_script))
        {{ $add_script }}
    @endif
    <style>
        body {
            background: rgb(34, 193, 195);
            background: linear-gradient(180deg, rgb(89, 233, 236) 0%, rgb(167, 104, 248) 100%);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="m-auto flex w-full max-w-screen-lg items-center">
                <div class="grow py-6 sm:px-5">
                    {{ $header }}
                </div>
                @if (isset($actions))
                    <div class="mr-5 flex gap-2">
                        {{ $actions }}
                    </div>
                @endif
            </header>
        @endif
        @if (session()->has('message'))
        <div class="mx-auto w-full max-w-screen-lg bg-green-100 rounded-xl bg-opacity-70 py-2 lg:px-8 text-green-700 ">
            {{ session()->get('message') }}
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="mx-auto w-full max-w-screen-lg bg-red-100 rounded-xl bg-opacity-70 py-2 lg:px-8 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
        @endif
        <!-- Page Content -->
        <main class="m-auto my-6 w-full max-w-screen-lg grow rounded-3xl bg-white bg-opacity-70 p-5 text-gray-700">
            {{ $slot }}
        </main>
    </div>
    <div class="m-10 flex w-full items-end">
        <div class="container mx-auto px-5 py-4">
            <p class="text-center text-sm capitalize text-gray-700">© 2023 NEXTWIL All rights reserved</p>
        </div>
    </div>
</body>

</html>
