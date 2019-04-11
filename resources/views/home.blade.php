@extends('layouts.app')

@section('content')

@if(isset($validator))
	<?php var_dump($validator); ?>
@endif

	<section id="home">
		<div class="container">
			<h1 class="p-5">{{ __('message.home') }}</h1>

			<form action="{{ route('number') }}" method="post">
				<input type="number" name="number">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit">
			</form>

		</div>
	</section>

@endsection

