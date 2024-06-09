<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    
     {{--link boostrap 5  --}}
    <link rel="stylesheet" href="{{ asset('assets/boostrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- toast --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="wrapper" id="xapp">
        <asside id="sidebar">
            <!-- content for sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Muri</a>
                </div><!--end logo  -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Muri
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }} sidebar-link ">
                            <i class="fa-solid fa-house"></i>&nbsp;Dashboard
                        </a>
                    </li>
                   
                    {{-- tolong buatkan sidebar dropdown lalu nanti routenya itu mengarah ke quizzes atau categories  --}}
                    <li class="sidebar-item">
                        <a href="{{ route('quizzes.index') }}" class="{{ request()->routeIs('quizzes.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-clipboard-list"></i>&nbsp;Quizzes
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-list"></i>&nbsp;Categories
                        </a>
                    </li>

                    {{-- sidebar untuk  --}}
                    <li class="sidebar-item">
                        <a href="{{ route('admin.barcodes.index') }}" class="{{ request()->routeIs('barcodes.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-barcode"></i>&nbsp;Barcodes
                        </a>
                    </li>

                    {{-- sidebar untuk users --}}

                    <li class="sidebar-item">
                        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-user"></i>&nbsp;Users
                        </a>
                    </li>

                    {{-- sidebar untuk leaderboard --}}
                    <li class="sidebar-item">
                        <a href="{{ route('admin.leaderboard') }}" class="{{ request()->routeIs('admin.leaderboard.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-trophy"></i>&nbsp;Leaderboard
                        </a>
                    </li>

                    {{-- sidebar untuk reward --}}
                    <li class="sidebar-item">
                        <a href="{{ route('admin.rewards.index') }}" class="{{ request()->routeIs('admin.rewards.*') ? 'active' : '' }} sidebar-link">
                            <i class="fa-solid fa-gift"></i>&nbsp;Rewards
                        </a>
                    </li>
                
                </ul>
            </div>
        </asside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="" 
                            class="avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>
                    </li>
                </ul>
            </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('content')                    
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-solid fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer fixed-bottom">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            &copy; 2024 Muri. All rights reserved.
                        </div>
                        <div class="d-flex">
                            <a href="#" class="text-muted">Privacy Policy</a>
                            <a href="#" class="text-muted ms-3">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>


    {{-- library boostrap 5.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="{{ asset('assets/boostrap/js/bootstrap.js') }}"></script>

    {{-- icon --}}
    <script src="https://kit.fontawesome.com/5f34f5e1d5.js" crossorigin="anonymous"></script>

    {{-- chart js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- script main js in folder public  --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
