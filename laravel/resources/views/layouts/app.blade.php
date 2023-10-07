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
            <header class="m-auto w-full max-w-screen-lg flex items-center">
                <div class="py-6 sm:px-5 grow">
                    {{ $header }}
                </div>
                @if (isset($actions))
                <div class="flex gap-2 mr-5">
                    {{ $actions }}
                </div>
                @endif
            </header>
        @endif
        @if (count($errors) > 0)
            <div class="text-red-600">
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
            <p class="text-sm capitalize text-gray-700 text-center">© 2023 NEXTWIL All rights reserved</p>
        </div>
    </div>
</body>

</html>
