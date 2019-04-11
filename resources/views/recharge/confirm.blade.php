@extends('layouts.app')

@section('content')

<div class="container">
	
	@if(Auth::check())
	
	<?php

	  $data=session()->get('tests');

	?>

  	<div class="my-5 py-5">
      <div class="row">
        <div class="col-md-12">
          <div class="row-fluid">
            <div class="span12">
              <h2 class="margin_bottom15">Order Review</h2>
              <table class="table table-products margin_bottom30 checkout_products border_all">
                <thead>
                  <tr>
                      <th>Product</th>
                      <th class="width80px mobile_pagination_center">Amount</th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="border_top">
                      <td>
                          <strong>Mobile Recharge</strong>
                      </td>
                      <td>
                        <span dir="ltr">
    											<strong>
    												${{$data['selectedproductprice']}}
                          </strong>
    										</span>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px; padding-bottom:5px;">
                          <span class="padding_left20">Mobile number:
                            <span dir="ltr" class="bold">{{ $data['destination_msisdn'] }}</span>
                            <span class="italic font-size12"> - Please make sure this number is correct.</span>
                          </span>
                      </td>
                    </tr>
                    <tr>
                        <td style="padding-top:5px; padding-bottom:5px;">
                          <span class="padding_left20">
  														Amount sent:
  														<strong>{{ $data['destination_currency'] }} {{ $data['selectedproduct'] }}</strong>
  												</span>
                        </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px; padding-bottom:5px;">
                        <span class="padding_left20">Operator: {{ $data['operators_name'] }}</span>
                      </td>
                    </tr>
                    <tr class="border_top">
                      <td><span class="pull-right line_height40">Total</span></td>
                      <td class="vertical_middle padding_vertical10"><span dir="ltr"><strong>${{$data['selectedproductprice']}}</strong></span></td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12" style="text-align: right;">
          @if(Auth::user()->balance>$data['selectedproductprice'])
            <a href="{{ url('recharge/confirms') }}" class="btn btn-success btn-lg">Send now</a>
          @else
            <p class="alert alert-danger p-2">Your remaining balance is insufficient for this purchase</p>
            <a href="{{ url('addwallet') }}" class="btn btn-success btn-lg">Add wallet</a>
          @endif
        </div>
      </div>
    
      @if (Session::has('message'))
       <div class="alert alert-{{ Session::get('code') }}">
        <p>{{ Session::get('message') }}</p>
       </div>
      @endif
  	</div>

   

	@else
	
  	<section id="login" class="my-5 p-5">
  		<div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header text-center"><h2>{{ __('Login') }}</h2></div>
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="form-group row text-left">
                      <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                      <div class="col-md-12">
                          <input id="email" type="email" class="this-d-form form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                          <input id="password" type="password" class="this-d-form form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-md-6 offset-md-4">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label for="remember" style="padding: 0px!important">
                                  {{ __('Remember Me') }}
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
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
  	</section>

	@endif
	
</div>

 
@endsection
