<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel with Ajax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/DataTables-1.13.3/css/dataTables.bootstrap5.min.css') }}" />
</head>
<body>
    <div class="d-flex" style="min-height: 100vh">
        {{-- Sidebar --}}
        <div class="bg-dark text-white d-flex flex-column align-items-start p-3 vh-100" style="width: 200px; position: sticky; top: 0;">
            <div class="mb-4 w-100 text-center">
                <img src="{{ asset('assets/image/logo.png') }}" alt="logo" class="img-fluid" style="max-width: 160px; height: auto;" />
            </div>

            <ul class="nav flex-column w-100">
                <li class="nav-item">
                    <a href="/" class="nav-link text-white px-3 py-2">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa') }}" class="nav-link text-white px-3 py-2">Data Mahasiswa</a>
                </li>
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="btn btn-link text-white p-0" style="text-align: left; width: 100%; border: none;">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="flex-fill">
            @if (Request::is('login'))
            <div class="p-4">
                @yield('content')
            </div>
            @else

            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <span class="text-dark">Sistem Informasi</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarContent">
                        {{-- LEFT SIDE --}}
                        <ul class="navbar-nav">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @endguest
                        </ul>

                        {{-- RIGHT SIDE --}}
                        @auth
                        <div class="d-flex align-items-center">
                            <span class="navbar-text me-3">Selamat Datang, {{ Auth::user()->name }}</span>
                        </div>
                        @endauth
                    </div>
                </div>
            </nav>

            {{-- Content Area --}}
            <div class="container-fluid p-4">
                @yield('content')
            </div>
            @endif
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.min.js') }}"></script> {{-- GANTI DARI bootstrap.bundle.min.js --}}
    <script src="{{ asset('assets/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables-1.13.3/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables-1.13.3/js/jquery.dataTables.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
