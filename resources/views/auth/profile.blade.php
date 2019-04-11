@extends('layouts.app')

@section('content')  

<section id="sms" class="p-5 m-5">
	  <div class="container">  

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

      <div class="jumbotron">
        <div class="row">
          <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
              <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png" alt="stack photo" class="img">
          </div>
          <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
              <div class="row">
                <div class="col-md-6">
                  <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="col-md-6 text-right">
                   <a href="{{ url('addwallet') }}" class="btn btn-success">Add wallet</a>
                   <a href="" class="btn btn-success">Edit account</a>
                </div>
              </div>
              <hr> 
              <div class="row">
                <div class="col-md-2">
                  <h2>Email:</h2> 
                  <h2>Phone:</h2> 
                  <h2>Country:</h2> 
                  <h2>Balance:</h2> 
                </div>
                <div class="col-md-6">
                  <h2>{{ Auth::user()->email }}</h2>
                  <h2>@if(Auth::user()->phone){{ Auth::user()->phone }}@else - @endif</h2>
                  <h2>@if(Auth::user()->country){{ Auth::user()->country }}@else - @endif</h2>
                  <h2>{{ Auth::user()->balance }} USD</h2>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
