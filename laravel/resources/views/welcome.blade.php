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
        <header class="m-auto flex w-full max-w-screen-lg items-center">
            <div class="m-auto py-10 sm:px-5">
                <h1
                    class="inline bg-gradient-to-tl from-sky-500 to-violet-900 bg-clip-text text-8xl font-extrabold text-transparent">
                    WIL Work Placement
                </h1>
            </div>
        </header>

        <!-- Page Content -->
        <main class="m-auto my-6 w-full max-w-screen-lg grow rounded-3xl bg-white bg-opacity-70 p-5 text-gray-700">
            @if (Route::has('login'))
                <div class="flex">
                    @auth
                        <div class="m-5 flex-1 rounded-2xl bg-white p-5">
                            <a href="{{ url('/home') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white">Home</a>
                        </div>
                    @else
                        <div class="m-5 flex-1 rounded-2xl bg-white p-10">
                            <h3 class="mb-8 text-lg font-semibold">Welcome back!</h3>
                            <p class="mb-8">Please login to your account to continue.</p>
                            <a href="{{ route('login') }}"
                                class="inline-block w-full rounded-full bg-gradient-to-tl from-sky-500 to-violet-900 py-4 text-center font-semibold uppercase text-white opacity-90 hover:opacity-100 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white text-lg">Log
                                in</a>
                        </div>
                        @if (Route::has('register'))
                            <div class="m-5 flex-1 rounded-2xl bg-white p-10">
                                <h3 class="mb-8 text-lg font-semibold">Don't have an account?</h3>
                            <p class="mb-8">Please sing up to start using today!</p>
                                <a href="{{ route('register') }}"
                                    class="inline-block w-full rounded-full bg-gradient-to-tl from-sky-500 to-violet-900 py-4 text-center font-semibold uppercase text-white opacity-90 hover:opacity-100 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white text-lg">Register</a>
                            </div>
                        @endif
                    @endauth
                </div>
            @endif
        </main>
    </div>
    <div class="m-10 flex w-full items-end">
        <div class="container mx-auto px-5 py-4">
            <p class="text-center text-sm capitalize text-gray-700">© 2023 NEXTWIL All rights reserved</p>
        </div>
    </div>
</body>

</html>
