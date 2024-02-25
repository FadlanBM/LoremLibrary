@extends('layouts.index')
@section('content')

    <body class="text-gray-800 font-inter">
        {{-- Sidenav --}}
        @component('partials.Navbar')
        @endcomponent
        {{-- EndSidenav --}}
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
            {{-- Navbar --}}
            @component('partials.employees.Sidenav')
            @endcomponent
            {{-- EndNavbar --}}
            @yield('content_admin')
        </main>
    </body>
@endsection
