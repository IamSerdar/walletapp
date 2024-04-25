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
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/dashlite.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="{{ asset('panel') }}/assets/css/theme.css?ver=3.1.3">
    @yield('css')
</head>

<body class="nk-body bg-white npc-default has-aside ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-lg wide-xl">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="/" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}"
                                         srcset="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}"
                                         srcset="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    @if($localeCode == app()->getLocale())
                                                        <img class="icon" src="{{ asset('panel') }}/images/flags/{{ $localeCode }}.png" alt="">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                                            <ul class="language-list">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <li>
                                                        <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="language-item">
                                                            <img src="{{ asset('panel') }}/images/flags/{{ $localeCode }}.png" alt="" class="language-flag">
                                                            <span class="language-name">{{ $properties['native'] }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li><!-- .dropdown -->
                                    <li class="dropdown notification-dropdown">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="icon-status @if (auth()->user()->notifications()->whereNull('read_at')->count()) icon-status-info @endif"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">@lang('main.notifications')</span>
                                                <a href="{{ route('notifications.all') }}">@lang('main.all')</a>
                                            </div>
                                            <?php
                                            $notifications = auth()->user()->notifications()->latest()->paginate(6); ?>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    @if(isset($notifications))
                                                        @foreach ($notifications as $notification)
                                                            <div class="nk-notification-item dropdown-inner">
                                                                <div class="nk-notification-content" style="width: 100%">
                                                                    <div class="nk-notification-text">
                                                                        <a href="{{ route('notifications.detail', $notification->id ) }}">
                                                                            <strong>{{ $notification->title }}</strong>
                                                                        </a>
                                                                    </div>
                                                                    <div class="nk-notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                                                </div>
                                                                @if(!$notification->pivot->read_at)
                                                                    <div class="nk-notification-content">
                                                                        <div style="">
                                                                            <em class="icon ni ni-eye" style="float: right;"></em>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                        </div>
                                    </li><!-- .dropdown -->
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
                                                        <span class="lead-text">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                                                        <span class="sub-text">+993 {{ auth()->user()->phone }}</span>
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
                                <div class="nk-sidebar-menu" data-simplebar>

                                    <ul class="nk-menu">
                                        @if (auth()->user()->isRoleDirector() || auth()->user()->isRoleEducator())
                                            <li class="nk-menu-heading">
                                                <h6 class="text-primary-alt" style="text-transform: uppercase;font-family: Roboto, sans-serif;">{{ auth()->user()->getGardenName() }}</h6>
                                            </li><!-- .nk-menu-heading -->
                                        @endif
                                        @if (auth()->user()->isRoleAdmin() || auth()->user()->isRoleDirector())
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">@lang('main.admin_section')</h6>
                                            </li><!-- .nk-menu-heading -->
                                            @if (auth()->user()->isRoleAdmin())
                                                <li class="nk-menu-item">
                                                    <a href="{{ route('gardens') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                                        <span class="nk-menu-text">@lang('main.gardens')</span>
                                                    </a>
                                                </li><!-- .nk-menu-item -->
                                            @endif
                                            <li class="nk-menu-item">
                                                <a href="{{ route('groups') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-folders"></em></span>
                                                    <span class="nk-menu-text">@lang('main.groups')</span>
                                                </a>
                                            </li><!-- .nk-menu-item -->
                                            <li class="nk-menu-item">
                                                <a href="{{ route('users', ['exceptRoles' => ['parent', 'child']]) }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                                    <span class="nk-menu-text">@lang('main.employees')</span>
                                                </a>
                                            </li><!-- .nk-menu-item -->
                                            <li class="nk-menu-item has-sub">
                                                <a href="{{ route('users', ['roles' => ['parent', 'child']]) }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                                    <span class="nk-menu-text">@lang('main.children_and_parents')</span>
                                                </a>
                                            </li><!-- .nk-menu-item -->
                                        @endif
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
                                            <div class="nk-footer-copyright"> &copy; 2023 <a href="#" target="_blank">@lang('main.app_name')</a>
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
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    <script src="{{ asset('panel') }}/assets/js/jquery-3.5.1.min.js?ver=3.1.3"></script>
    <script src="{{ asset('panel') }}/assets/js/bundle.js?ver=3.1.3"></script>
    <script src="{{ asset('panel') }}/assets/js/scripts.js?ver=3.1.3"></script>
    <script src="{{ asset('panel') }}/assets/js/charts/gd-default.js?ver=3.1.3"></script>
    @yield('js')
</body>

</html>
