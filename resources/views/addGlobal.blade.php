@extends('layouts.main.app')

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
							<li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
							<li class="breadcrumb-item"><a class="text-white" href="#">Dashboard</a></li>
							<li class="breadcrumb-item"><a class="text-white" href="{{ route('seo-home') }}">Seo</a></li>
							<li class="breadcrumb-item text-white active" aria-current="page">Add Global</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ==========================
		BREADCRUMB - END
	=========================== -->


	<!-- ==========================
		PAGE CONTENT - START
	=========================== -->
	<section class="content news">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<h2 style="text-align:center;">Create global SEO data for your whole application</h2>
					<h4 class="text-center"><b>Note: </b>You can create multiple global sets, but only the first in the list will ever be applied</h4>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>
								<i class="fa fa-bullhorn section-title-icon"></i>&nbsp;
								<span class="col-form-label">
									<small>See label text above form fields for hints on how these SEO elements work</small>
								</span>
							</h4>
						</div>
						<?php
						/*$form::open('addGlobal', $this->controller->config->getFileRootPath().'seo/saveNewGlobal', 'post'); ?>*/ ?>
						<form action='saveNewGlobal' method='post'>
						<div class="panel-body panel-primary">
							<div class="container bg-light p-2">
								<fieldset>
									<legend>Site Geo Data</legend>
									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<label for='seo_global_geo_placename'>Geo Place name (Country/City e.g. England or London)</label>
										<input typpe='text' name='seo_global_geo_placename' id='seo_global_geo_placename'  class='form-control' />
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title"><small>The Geo-region in the world, where your application is in use e.g. UK, for
											the United Kingdom, or FR for France etc.
											</small>
										</span>
										<label for='seo_global_geo_region'>Geo Region (country abbrv e.g. UK or US)</label>
										<input type='text' id='seo_global_geo_region' name='seo_global_geo_region' class='form-control' />
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
											<span class="font-weight-bold section-title"><small>The geo-location or longitude & latitude digits of the place where your 
											application is currently active. You can find these coordinates from Google. Just give it the name of your location. 
											</small>
										</span>

										<label for='seo_global_geo_position'>Geo Position</label>
										<input type='text' id='seo_global_geo_position' name='seo_global_geo_position' 
											class='form-control' /> 
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">Alternate Reflangs. This section is for URL links for applications that have multiple
											versions being served in different languages. Leave it blank if that does not apply to your application. We provide two fields 
											here because that will apply to most sites, but feel free to add more fields as your application has need for. Do not forget to 
											add the new fields to the DB table 'seo_global' & required code to handle the submission if you do so. Adding data for your 
											site for Engish will look like this:
												'https://yoursite/en' 
										</span>

										<label for='seo_global_reflang_alternate1'>Reflang alternate 1'</label>
										<input type='text' id='seo_global_reflang_alternate1' name='seo_global_reflang_alternate1'  
											class='form-control' /> 
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
									<span class="font-weight-bold section-title">Alternate Reflangs. This section is for URL links for applications that have multiple
											versions being served in different languages. Leave it blank if that does not apply to your application. We provide two fields 
											here because that will apply to most sites, but feel free to add more fields as your application has need for. Do not forget to 
											add the new fields to the DB table 'seo_global' & required code to handle the submission if you do so. Adding data for your 
											site for French will look like this:
												'https://yoursite/fre' 
										</span>

										<label for='seo_global_reflang_alternate2'>Reflang alternate 2</label>
										<input type='text' id='seo_global_reflang_alternate2' name='seo_global_reflang_alternate2' 
											class='form-control' /> 
									</div>
								</fieldset>	

								<?php /*
								<fieldset>
									<legend>Open Graph: Global tags <small>(Facebook og)</small></legend>
									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">This is referring to the Geo-location language where your site is active. This is for
											Facebook. For a web application in the Uk, the entry will be 'en_UK'. This is the international language code for UK English. 
											For the Unites States, that will be 'en_US'. 
											</small>
										</span>
										<?php  
										$form::label('seo_global_og_locale', 'Locale');
										$form::input('seo_global_og_locale', 'text', ['class' => 'form-control']);
										?>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">This simply refers to your site name. So if your web application is 
											'https://yoursiteName.com', you will enter here only your site/business name-which will be something like: 'YoursiteName'  
										</span>
										<?php 
										$form::label('seo_global_og_site', 'OG: Site');
										$form::input('seo_global_og_site', 'text', ['class' => 'form-control']); 
										?>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">This just needs the fully qualified URL to your site's Facebook page. This could be
												your application's business page link on Facebook, or an individual's Facebook link, if the web application was published 
												by that person.  
										</span>
										<?php 
										$form::label('seo_global_og_article_publisher', 'OG: Article Publisher');
										$form::input('seo_global_og_article_publisher', 'text', ['class' => 'form-control']); 
										?>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">This is very similar to the above article publisher. This is in case the web app
											was published by an individual as opposed to a business. Feel free to enter the link for which ever applies to your app, and 
											leave the other blank.
										</span>
										<?php 
										$form::label('seo_global_og_author', 'OG: Author');
										$form::input('seo_global_og_author', 'textarea', ['class' => 'form-control']); 
										?>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">If you have the Facebook page ID for your application; put it in here. 
											Note: This is not the link to a Facebok page-rather its just the digits that make up the Facebook page ID. 
											An example is like 1234567890123456
										</span>
										<?php 
										$form::label('seo_global_fb_id', 'Facebook Page ID');
										$form::input('seo_global_fb_id', 'text', ['class' => 'form-control']); 
										?>
									</div>
								</fieldset>	

								<fieldset>
									<legend>Twitter Card Global <small>(Twitter tags)</small></legend>
									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">Twitter card: an example value could be 'summary', or 'article' etc. For global 
											settings, it would probably be be 'website'</span>
										<?php 
										$form::label('seo_global_twitter_card', 'Twitter Card');
										$form::input('seo_global_twitter_card', 'text', ['class' => 'form-control']); 
										?>
									</div>

									<div class="col-sm-12 col-md-12 col-lg-12 form-group">
										<span class="font-weight-bold section-title">Just like a Facebook ID above; this requires the URL to the official Twitter 
											page of your application, if you have one.
										</span>
										<?php 
										$form::label('seo_global_twitter_site', 'Twitter Site');
										$form::input('seo_global_twitter_site', 'textarea', ['class' => 'form-control']); 
										?>
										</div>
								</fieldset> */ ?>
							</div>
						</div>
						<div class="panel-footer">
							<div class="form-group">
								<a href='/seo' class='btn btn-warning btn-sm'>Cancel</a>
								<input type='submit' value='Save Changes' class='btn btn-primary btn-sm ml-3' />
							</div>		
						</div>		
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ==========================
		PAGE CONTENT - END
	=========================== -->
