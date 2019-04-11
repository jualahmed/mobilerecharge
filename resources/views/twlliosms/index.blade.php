@extends('layouts.app')

@section('content')  

<section id="sms" class="p-5 m-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="{{ url('images/sms.png') }}" alt="">
			</div>
			<div class="col-md-6">
				<twilliosms></twilliosms>
				
			</div>
		</div>
	</div>
</section>

@endsection
