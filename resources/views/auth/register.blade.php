@extends('layouts.app')

@section('content')
<section id="auth">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-md-5">
        <h2>A better way to get customer insights</h2>
        <h3>With Trustpilot, you can</h3>
        <ul class="list-group">
            <li class="py-3 font-weight-bold">Gain insights directly from those who matter most — your customers</li>
            <li class="py-3 font-weight-bold">Make improvements based on feedback while increasing conversions</li>
            <li class="py-3 font-weight-bold">Let your business shine with Trustpilot stars and customer stories</li>
            <li class="py-3 font-weight-bold">Let your business shine with Trustpilot stars and customer stories</li>
        </ul>
      </div>
      <div class="col-md-7">
          <div class="card shadow">
              <div class="card-header text-center"><h2>{{ __('Create new account') }}</h2></div>
              <div class="row py-5">
                <div class="col-md-3 offset-md-3">
                  <button class="p-3 btn-block btn-social btn-facebook">
                    <i style="margin-top: 11px!important;" class="mt-3 mr-4 fab fa-facebook-f"></i><span class="pl-3">Sign in with Facebook</span>
                  </button>
                </div>
                <div class="col-md-3">
                  <button class="p-3 btn-block btn-social btn-google">
                    <i style="margin-top: 11px!important;" class="mt-2 mr-4 fab fa-google-plus-g"></i> <span class="pl-4">Sign in with Google</span>
                  </button>
                </div>
              </div>
              <p class="text-center font-weight-bold">OR</p>
              <div class="card-body p-5">
                  <form method="POST" action="{{ route('register') }}">
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-md-12 col-form-label font-weight-bold">{{ __('Name') }}</label>

                          <div class="col-md-12">
                              <input id="name" type="text"  placeholder="Enter you name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="email" class="col-md-12 col-form-label font-weight-bold">{{ __('E-Mail Address') }}</label>

                          <div class="col-md-12">
                              <input id="email" type="email" placeholder="Enter you email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-12 col-form-label font-weight-bold">{{ __('Password') }}</label>

                          <div class="col-md-12">
                              <input id="password"  placeholder="Enter you password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password-confirm" class="col-md-12 col-form-label font-weight-bold">{{ __('Confirm Password') }}</label>

                          <div class="col-md-12">
                              <input id="password-confirm"  placeholder="Confirm you password" type="password" class="form-control" name="password_confirmation" required>
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-3">
                            <button type="submit" class="font-weight-bold btn btn-primary btn btn-lg btn-primary btn-block text-uppercase">
                                {{ __('Create new account') }}
                            </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
  </div>
</section>
@endsection
