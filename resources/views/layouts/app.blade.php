<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/smart_wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/smart_wizard_theme_arrows.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-distributed-with-address-and-phones.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>

</head>
<body>
  <input type="hidden" id="csrftoken" value="{{ csrf_token() }}">
  <input type="hidden" id="applocal" value="{{ config('app.locale') }}">
   <div id="app">
      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ url('images/logo.png')  }}" alt="" width="10%">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('recharge') }}">{{ __('Recharge') }}</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('sms') }}">{{ __('Send sms') }}</a>
                      </li>
                      @guest
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                          <li class="nav-item">

                              <a data-toggle="modal" data-target="#exampleModalLong" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('profile') }}" class="dropdown-item" onclick="location.href='profile'">
                                  {{ __('My Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                              </div>
                          </li>
                      @endguest
                    
                      @if(config('app.locale')=='en')
                       <li class="nav-item">
                        <a class="nav-link" rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('es', null, [], true) }}">
                          <img src="{{ url('images/spain.png') }}" alt="" width="25px">
                           Spanish
                        </a>
                      </li>
                    
                      @else
                      <li class="nav-item">
                        <a class="nav-link" rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                          <img src="{{ url('images/uk.png') }}" alt="" width="25px">
                           English
                        </a>
                      </li>
                      @endif
                      <li class="nav-item pr-0" style="color: #239CCF!important;">
                        <a href="{{ url('cart') }}">{{ Cart::count() }}
                          <i class="fas fa-cart-plus fa-2x"></i>
                        </a>
                      </li>

                  </ul>
              </div>
          </div>
      </nav>

     <div class="container">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
              <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
          @endforeach
        </div>
      </div>



<!-- Login model -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Login') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row p-3">
          <div class="col-md-6">
            <button class="p-3 btn-block btn-social btn-facebook">
              <i style="margin-top: 11px!important;" class="mt-3 mr-4 fab fa-facebook-f"></i><span class="pl-3">Sign in with Facebook</span>
            </button>
          </div>
          <div class="col-md-6">
            <button class="p-3 btn-block btn-social btn-google">
              <i style="margin-top: 11px!important;" class="mt-2 mr-4 fab fa-google-plus-g"></i> <span class="pl-4">Sign in with Google</span>
            </button>
          </div>
      </div>
      <p class="text-center">OR</p>
      <div class="card">
        <div class="card-body card-signin">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember" style="padding: 0px;">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2 text-center">
                        <button type="submit" class="btn btn-primary btn btn-lg btn-primary btn-block text-uppercase">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                              {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>



      <main style="background: #fff;">
        @yield('content')
      </main>
      
     
      <footer class="footer-distributed" style="margin-top: 0px;">
        <div class="container">
          <div class="footer-left">
            <h3>Company<span>logo</span></h3>

            <p class="footer-links">
              <a href="{{ url('/') }}">Home</a>
              <a href="{{ url('/recharge') }}">Recharge</a>
              <a href="{{ url('/sms') }}">Sms</a>
              <a href="{{ url('/register') }}">About</a>
              <a data-toggle="modal" data-target="#exampleModalLong" href="//localhost:3000/es/login" class="nav-link">Login</a>
            </p>

            <p class="footer-company-name">Company Name &copy; 2015</p>
          </div>
          <div class="footer-center">
            <div>
              <i class="fa fa-map-marker"></i>
              <p><span>21 Revolution Street</span> Paris, France</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+1 555 123456</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p><a href="mailto:support@company.com">support@company.com</a></p>
            </div>
          </div>
          <div class="footer-right">
            <p class="footer-company-about">
              <span>About the company</span>
              Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
            </p>

            <div class="footer-icons">
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-github"></i></a>
            </div>
          </div>
        </div>
      </footer>
    </div>

    @yield('script')

</body>
</html>
