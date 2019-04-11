@extends('layouts.app')

@section('content') 
	<section id="addwallet" class="p-5 m-5">
		@if(session()->has('filed'))
			<h2 class="text-danger">{{ session()->get('filed') }}</h2>
		@endif
		<form action="{{ route('paypal.express-checkout') }}">
		  <div class="form-group">
		    <h2 class="font-weight-bold">Amount</h2>
		    <input type="number" name="price" class="form-control this-d-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Amount">
		    <small id="emailHelp" class="form-text text-muted py-2 font-weight-bold">Enter the amount to add .</small>
		  </div>
	  	<button type="submit" class="btn btn-primary box_sha this-btn">Pay with paypal</button>
		</form>
	</section>
@endsection