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
                                <li class="nk-menu-item  {{ request()->is('serviceAccounts') ? 'active' : '' }}">
                                    <a href="{{ Route('serviceAccounts.') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text">Service Accounts</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item  {{ request()->is('servicePayments') ? 'active' : '' }}">
                                    <a href="{{ Route('servicePayments.') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>
                                        <span class="nk-menu-text">Service Payment</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item  {{ request()->is('transactions') ? 'active' : '' }}">
                                    <a href="{{ Route('transactions.') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-activity-round"></em></span>
                                        <span class="nk-menu-text">Transactions</span>
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
    <script src="{{ asset('panel') }}/assets/js/bundle.js?ver=1.4.0"></script>
    <script src="{{ asset('panel') }}/assets/js/scripts.js?ver=1.4.0"></script>
    @yield('js')
</body>

</html>
