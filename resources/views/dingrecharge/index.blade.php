@extends('layouts.app')

@section('content')

@if(isset($validator))
	<?php var_dump($validator); ?>
@endif

	<section id="dingrecharge">
		<div class="container">
		 	<div class="py-5">
			 	<div class="row">
				 	<div class="col-md-12 text-center">
					 	<h2>Delivering mobile top-up to millions worldwide</h2>
						 <p class="pb-5">it's easy to make your family and friends happy! It takes only seconds to top up their mobiles back home. Fast and secure mobile recharges, exciting bonuses and more.</p>
					</div>
				 	<div class="col-md-9 m-auto">
					 	<div class="box-shadow">
							<dingrecharge1></dingrecharge1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="faq">
		<div class="container py-5">

			<h2>Frequently Asked Questions</h2>

			<div class="accordion">
			<div class="accordion-item">
				<a class="active">Why is the moon sometimes out during the day?</a>
				<div class="content active">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
				</div>
			</div>
			<div class="accordion-item">
				<a>Why is the sky blue?</a>
				<div class="content">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
				</div>
			</div>
			<div class="accordion-item">
				<a>Will we ever discover aliens?</a>
				<div class="content">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
				</div>
			</div>
			<div class="accordion-item">
				<a>How much does the Earth weigh?</a>
				<div class="content">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
				</div>
			</div>
			<div class="accordion-item">
				<a>How do airplanes stay up?</a>
				<div class="content">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
				</div>
			</div>
			</div>

		</div>
	</section>

@endsection

