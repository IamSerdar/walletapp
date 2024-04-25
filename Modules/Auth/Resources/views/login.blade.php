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
    <title>@lang('main.sign_in') | @lang('main.app_name')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/dashlite.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="{{ asset('panel') }}/assets/css/theme.css?ver=3.1.3">
</head>

<body class="nk-body npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="{{ route('manager')}}" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}" srcset="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/logo/vector/default-monochrome-black.png') }}" srcset="{{ asset('assets/logo/vector/default-monochrome-black.png')  }}">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">@lang('main.sign_in')</h5>
                                        <div class="nk-block-des">
                                            <p>@lang('main.access_dashboard')</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                @if (session()->has('error'))
                                    <div class="alert alert-fill alert-icon alert-danger" role="alert">
                                        <em class="icon ni ni-alert-circle"></em>
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">@lang('main.phone_or_username')</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg  @error('username') is-invalid @enderror" value="{{ old('username') }}"
                                                id="username" name="username" placeholder="@lang('main.enter_phone_or_username')">
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                            @else
                                                <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                            @endif
                                        </div>
                                    </div><!-- .form-group -->
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">@lang('main.password')</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password"
                                                value="{{ old('password') }}" placeholder="@lang('main.enter_password')">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                            @else
                                                <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                            @endif
                                        </div>
                                    </div><!-- .form-group -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">@lang('main.sign_in')</button>
                                    </div>
                                </form><!-- form -->
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-bs-toggle="dropdown" data-offset="0,10">
                                                <small>{{ LaravelLocalization::getCurrentLocaleName() }}</small>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end dropdown-menu-s1">
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
                                        </li>
                                    </ul><!-- .nav -->
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        <div class="nk-split-content nk-split-stretch bg-abstract"></div><!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('panel') }}/assets/js/bundle.js?ver=3.1.3"></script>
    <script src="{{ asset('panel') }}/assets/js/scripts.js?ver=3.1.3"></script>
    <!-- select region modal -->

</html>
