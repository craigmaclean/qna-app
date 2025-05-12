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

        <!-- FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- CSS -->
        @vite(['resources/css/app.css'])

        <script src="{{ mix('resources/js/sidebar.js') }}" defer></script>


    </head>
    <body class="font-sans antialiased">
        <div class="wrapper">

            <!-- Sidebar -->
            <aside id="sidebar">
                <button onclick=toggleSidebar() id="sidebarToggle" class="is-open px-2.5 absolute fill-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#94A3B8"><path d="M660-320v-320L500-480l160 160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm120-80v-560H200v560h120Zm80 0h360v-560H400v560Zm-80 0H200h120Z"/></svg>
                </button>

                <!-- Logo Section -->
                <a href="/dashboard"><img src="{{ asset('images/QNA-final-logo.png') }}" class="block object-contain max-w-full mx-auto mb-6 text-center max-h-40" alt="QNA Contracting" /></a>

                <!-- Navigation Section -->
                <nav id="primaryMenu" class="w-full space-y-4">
                    <ul>
                        <!--<li>
                            <span class="logo">coding2go</span>
                            <button  id="toggle-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"/></svg>
                            </button>
                        </li>-->
                        <li class="active">
                            <a href="/dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-200h120v-200q0-17 11.5-28.5T400-440h160q17 0 28.5 11.5T600-400v200h120v-360L480-740 240-560v360Zm-80 0v-360q0-19 8.5-36t23.5-28l240-180q21-16 48-16t48 16l240 180q15 11 23.5 28t8.5 36v360q0 33-23.5 56.5T720-120H560q-17 0-28.5-11.5T520-160v-200h-80v200q0 17-11.5 28.5T400-120H240q-33 0-56.5-23.5T160-200Zm320-270Z"/></svg>
                            <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/bids">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#94A3B8"><path d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-40-343 237-137-237-137-237 137 237 137ZM160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11L160-252Zm320-228Z"/></svg>
                            <span>Bids</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#94A3B8"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
                            <span>Prospects</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#94A3B8"><path d="M400-120q-17 0-28.5-11.5T360-160v-480H160q0-83 58.5-141.5T360-840h240v120l120-120h80v320h-80L600-640v480q0 17-11.5 28.5T560-120H400Zm40-80h80v-240h-80v240Zm0-320h80v-240H360q-26 0-49 10.5T271-720h169v200Zm40 40Z"/></svg>
                            <span>Contractors</span>
                            </a>
                        </li>
                    </ul>
                </nav>


                {{-- <div class="flex">
                    <img src="{{ asset('images/QNA-final-logo.png') }}" alt="" class="w-full max-w-sm avatar">

                    <div class="text-red user-info">
                        <h4 class="text-sm font-bold text-gray-900">Adrian Ulsh</h4>
                        <h5 class="text-xs text-gray-600">Owner</h5>
                    </div>

                    <button type="button" class="ml-auto text-gray-500 hover:text-gray-800">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div> --}}

                <!-- User Info Section -->
                <div class="flex items-center w-full mt-auto">
                    <!-- Avatar -->
                    <!--<img src="avatar.jpg" alt="User Avatar" class="object-cover w-12 h-12 rounded-full">-->

                    <!-- User Info -->
                    <div class="ml-3">
                        <h4 class="text-sm font-bold text-gray-900">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                        <p class="text-xs text-gray-600">{{ auth()->user()->position }}</p>
                    </div>

                    <!-- Dropdown Trigger -->
                    <button type="button" class="ml-auto text-gray-500 hover:text-gray-800" id="toggleProfileSubMenu">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

                <div id="userInfoMenu" class="fixed bottom-0 left-0 hidden bg-white">
                    <ul class="text-gray-600">
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>



















            </aside>





            {{-- @include('layouts.navigation') --}}


            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset--}}

            <!-- Page Content -->
            <!--<main class="p-6 overflow-y-auto no-scrollbar bg-slate-100" style="transition: 1s ease;">-->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Scripts -->
        @vite(['resources/js/app.js'])

    </body>
</html>
