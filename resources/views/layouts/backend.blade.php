<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 sidebar">
                <h1 class="p-4 logo">
                    <a href="#" class="text-decoration-none logo-txt">Blog</a>
                </h1>
                <ul class="list">
                    <li class="list-item d-flex align-items-center {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="list-item d-flex align-items-center {{ Request::is('admin/category*') ? 'active' : '' }}">
                        <i class="fa-solid fa-tags"></i><a href="{{ route('admin.category.index') }}" class="nav-link">Category</a>
                    </li>
                    <li class="list-item d-flex align-items-center {{ Request::is('product*') ? 'active' : '' }}">
                        <i class="fa-solid fa-box-open"></i><a href="{{ route('admin.product.index') }}" class="nav-link">Product</a>
                    </li>
                    <li class="list-item d-flex align-items-center {{ Request::is('admin/profile*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus"></i><a href="{{ route('admin.profile.index') }}" class="nav-link">User</a>
                    </li>
                </ul>
            </div>
            <div class="col-10 content" style="background-color: #e3e3e3;">
                <div class="nav d-flex justify-content-between">
                    <div class="">

                    </div>
                    <div class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->guard('admin')->user()->name }}
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <a href="{{ route('admin.profile.show', Auth::guard('admin')->user()->id) }}" class="dropdown-item">profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="" class="d-none">
                                @csrf
                            </form>
                        </div>    
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
