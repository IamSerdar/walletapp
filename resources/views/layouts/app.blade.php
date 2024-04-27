<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="">
    <!-- Page Title  -->
    <title>@lang('main.app_name')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/dashlite.css?ver=1.4.0">
    <link id="skin-default" rel="stylesheet" href="{{ asset('panel') }}/assets/css/theme.css?ver=1.4.0">
    @yield('css')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
    {{-- <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-lg wide-xl">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="/" class="logo-link">
                                    <h3>Wallet App</h3>

                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle me-lg-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span><em class="icon ni ni-user-alt"></em></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ auth()->user()->username }}</span>
                                                    </div>
                                                    <div class="user-action">
                                                        <a class="btn btn-icon me-n2" href="{{ route('profile') }}"><em class="icon ni ni-setting"></em></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('profile') }}"><em class="icon ni ni-user-alt"></em><span>@lang('main.my_profile')</span></a></li>
                                                    <li><a href="{{ route('profile') }}"><em class="icon ni ni-setting-alt"></em><span>@lang('main.profile_settings')</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            <em class="icon ni ni-signout"></em><span>@lang('main.log_out')</span>
                                                        </a>
                                                        <form id="logout-form" class="d-none"
                                                            action="{{ route('logout') }}" method="POST">@csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                    <li class="d-lg-none">
                                        <a href="#" class="toggle nk-quick-nav-icon me-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a>
                                    </li>
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->

                <div class="nk-content ">
                    <div class="container wide-xl">
                        <div class="nk-content-inner">
                            <div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
                                <div class="nk-sidebar-menu " data-simplebar>
                                    <ul class="nk-menu">
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">ADMIN SECTION</h6>
                                            </li><!-- .nk-menu-heading -->
                                            <li class="nk-menu-item has-sub">
                                                <a href="{{ route('users') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                                    <span class="nk-menu-text">Users</span>
                                                </a>
                                            </li><!-- .nk-menu-item -->
                                    </ul><!-- .nk-menu -->
                                </div><!-- .nk-sidebar-menu -->
                                <div class="nk-aside-close">
                                    <a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
                                </div><!-- .nk-aside-close -->
                            </div><!-- .nk-aside -->

                            <div class="nk-content-body">
                                @include('include._flash_messages')
                                @yield('content')
                                <!-- footer @s -->
                                <div class="nk-footer">
                                    <div class="container wide-xl">
                                        <div class="nk-footer-wrap g-2">
                                            <div class="nk-footer-copyright"> &copy; 2023 <a href="#" target="_blank">Wallet</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer @e -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div> --}}
    <div class="nk-app-root">
        <!-- main  -->
        <div class="nk-main ">
            <!-- sidebar -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ Route('manager') }}" class="logo-link">
                            {{-- <img class="logo-light logo-img" src="{{ asset('panel/logo/logo.png')  }}"
                                 srcset="{{ asset('panel/logo/logo.png')  }}" alt="logo" width="200px" >
                            <img class="logo-dark logo-img" src="{{ asset('panel/logo/logo.png')  }}"
                                 srcset="{{ asset('panel/logo/logo.png') }}" alt="logo-dark" width="200px" > --}}
                                 <h3 style="color:#fff">Wallet App</h3>
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item  {{ request()->is('users') ? 'active' : '' }}">
                                    <a href="{{ Route('users.') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                            </ul>
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <div class="nk-sidebar-brand">
                                    <a href="{{ Route('manager') }}" class="logo-link nk-sidebar-logo">
                                        <h3>Wallet App</h3>
                                    </a>
                                </div>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-signout"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">@csrf</form>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <div class="nk-content">
                    @include('include._flash_messages')
                    @yield('content')
                </div>
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                 &copy; 2024 <a _blank href="#" style="color:red">Wallet App </a>All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    <script src="{{ asset('panel') }}/assets/js/jquery-3.5.1.min.js?ver=3.1.3"></script>
    <script src="{{ asset('panel') }}/assets/js/bundle.js?ver=1.4.0"></script>
    <script src="{{ asset('panel') }}/assets/js/scripts.js?ver=1.4.0"></script>
    @yield('js')
</body>

</html>
