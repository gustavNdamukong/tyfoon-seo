@extends('tyfoon-seo::layouts.main.app')

@section('content')

	<!-- ==========================
	BREADCRUMB - START
	=========================== -->
	<div class="container-xxl py-5 bg-primary hero-header mb-5">
		<div class="container my-5 py-5 px-lg-5">
			<div class="row g-5 py-5">
				<div class="col-12 text-center">
					<h1 class="text-white animated zoomIn">SEO</h1>
					<hr class="bg-white mx-auto mt-0" style="width: 90px;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-center">
							<li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
							<li class="breadcrumb-item"><a class="text-white" href="#">Dashboard</a></li>
							<li class="breadcrumb-item"><a class="text-white" href="{{ route('seo-home') }}">SEO</a></li>
							<li class="breadcrumb-item text-white active" aria-current="page">Global Detail</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ==========================
		BREADCRUMB - END
	=========================== -->

	<section class="content news">
		<div class="container">
			<div class="row">

				@include('tyfoon-seo::partials/_notificationsPartial')
				@include('tyfoon-seo::partials/_sideSlideInMenuPartial')
				@include('tyfoon-seo::partials/_jsSeoValidationPartial')

				<div class="col-sm-12 col-lg-12">
					<h2 class="text-center">Global SEO data record ID: {{ $globalData['id'] }}</h2>
					<div class="well">
						<a href="{{ route('seo-home') }}" class="btn btn-primary btn-sm">Back to all pages</a>
					</div>
					<?php
					if ($globalData)
					{ ?>
						<div class="col-md-12 well">
							<div class="card mt-5 current-data-card">
								<div class="card-header bg-white">											

									<p class="card-text"><span class="label">Geo Country/City </span>{{ $globalData['geo_placename'] ?? ' ' }}</p>
									<p class="card-text"><span class="label">Geo Region </span>{{ $globalData['geo_region'] ?? ' ' }}</p>
									<p class="card-text"><span class="label">Geo Position </span>{{ $globalData['geo_position'] ?? ' ' }}</p>
								</div>

								<div class="card-body">
									<div class="container bg-light p-2">
										<h4>Open Graph Settings <small>(Facebook:og tags)</small></h4>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">FB Id</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $globalData['fb_id'] ?? ' ' }}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Og:site</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $globalData['og_site'] ?? ' ' }}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Og:locale</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $globalData['og_locale'] ?? ' ' }}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Og:author</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $globalData['og_author'] ?? ' ' }}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Og:publisher</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $globalData['og_article_publisher'] ?? ' ' }}
												</div>
											</div>
										</div>

										{{-- <div class="row">
											<div class="col-sm-12 col-md-2">
												<span class="font-weight-bold section-title">Og:video</span>
											</div>

											<div class="col-md-10 col-sm-12">
												<div id="policy-number"
													class="bg-white rounded-top p1-2">
														{{ $globalData['og_video'] ?? ' ' }}
												</div>
											</div>
										</div> --}}
									
										<h4>Twitter Card global settings <small>(Twitter tags)</small></h4>
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Twitter Card</span>
													</div>

													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $globalData['twitter_card'] ?? ' ' }}
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Twitter Site</span>
													</div>

													<div class="col-sm-12 col-md-8 col-lg-8 ">
														<div class="bg-white rounded-top p1-2">
															{{ $globalData['twitter_site'] ?? ' ' }}
														</div>
													</div>
												</div>
											</div>
										</div>

										<h4>Miscellaneos global SEO settings</h4>
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Reflang Alternate1</span>
													</div>

													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $globalData['reflang_alternate1'] ?? ' ' }}
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-4 col-sm-12">
														<span class="font-weight-bold section-title">Reflang Alternate2</span>
													</div>

													<div class="col-md-8 col-sm-12">
														<div class="bg-white rounded-top p1-2">
															{{ $globalData['reflang_alternate2'] ?? ' ' }}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="row">
												<div class="col-sm-6 col-md-6 col-lg-6">
													<b>Actions</b>
												</div>

												<div class="col-sm-6 col-md-6 col-lg-6">
													<a type="button" href="{{ route('edit-global-seo', $globalData['id']) }}" 
														class="btn btn-warning">
															<i class="fa fa-pen"></i>
													</a>&nbsp;&nbsp;

													<form action="{{ route('delete-global-seo') }}" method="POST" id="deleteForm">
														@csrf
														<input type="hidden" name="recordId" value="{{ $globalData['id'] }}">
														<a onclick="confirmDelete(event)"
															class="btn btn-danger"><i class="fa fa-trash"></i>
														</a>
													</form>

													<a href="{{ route('seo-home') }}" class="btn btn-primary btn-sm">Back to all pages</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					} 
					else 
					{ ?>
						<p style="color:red;text-align: center;">
								<b>No global SEO data was found for that record!</b>
						</p>
						<h3 style="font-weight:bold;color:#3d78d8;">
								<a href="{{ route('seo-home') }}" class="btn btn-primary btn-sm">Back to all pages</a>
						</h3>
						<?php
					} ?>	
				</div>
			</div>
		</div>
	</section>
@endsection

