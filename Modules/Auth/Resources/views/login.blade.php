<!DOCTYPE html>
<html lang="en" class="js">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@@page-discription">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('panel/logo/logo4.jpg') }}">
    <!-- Page Title  -->
    <title> Login | Wallet App</title>
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/dashlite.css?ver=1.4.0">
    <link id="skin-default" rel="stylesheet" href="{{ asset('panel') }}/assets/css/theme.css?ver=1.4.0">
  </head>
<body class="nk-body npc-crypto ui-clean pg-auth">
  <div class="nk-app-root">
    <div class="nk-split nk-split-page nk-split-md">
      <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
        {{-- <div class="absolute-top-right d-lg-none p-3 p-sm-5">
          <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
        </div> --}}
        <div class="nk-block nk-block-middle nk-auth-body">
          <div class="brand-logo pb-5">
            <a href="#" class="logo-link">
                <h3>Wallet App</h3>
            </a>
          </div>
          <div class="nk-block-head">
            <div class="nk-block-head-content">
              <h5 class="nk-block-title">Sign in</h5>
              <div class="nk-block-des">
                <p>Access the dashboard panel using your username and password.</p>
              </div>
            </div>
          </div>
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
                        <label class="form-label" for="username">Username</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg" id="username" placeholder="Enter your username" name="username"
                          {{ $errors->has('username') ? ' is-invalid' : '' }} value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                      <em class="passcode-icon icon-show icon ni ni-eye"></em>
                      <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password"
                           placeholder="Enter your password">
                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-lg btn-primary btn-block">Login</button>
                </div>
              </form>
        </div>
      </div>
      <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg"data-toggle-overlay="true">
        <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
          <div class="slider-init" data-slick='{"dots":false, "arrows":false}'>
            <div class="slider-item">
              <div class="nk-feature nk-feature-center">
                <div class="nk-feature-img">
                  <img class="round" src="{{ asset('panel/images/login.jpg') }}" srcset="" alt="img">
                </div>
              </div>
            </div>
          </div>
          <div class="slider-dots"></div>
          <div class="slider-arrows"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- JavaScript -->
  <script src="{{ asset('panel') }}/assets/js/bundle.js?ver=1.4.0"></script>
  <script src="{{ asset('panel') }}/assets/js/scripts.js?ver=1.4.0"></script>
  <script src="{{ asset('panel') }}/assets/js/charts/gd-general.js?ver=1.4.0"></script>
</body>
</html>
