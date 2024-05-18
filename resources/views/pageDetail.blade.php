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
								<li class="breadcrumb-item text-white active" aria-current="page">Page Detail</li>
							</ol>
						</nav>
					</div>
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

				@include('tyfoon-seo::partials/_notificationsPartial')
				@include('tyfoon-seo::partials/_sideSlideInMenuPartial')
				@include('tyfoon-seo::partials/_jsSeoValidationPartial')

				<div class="col-sm-12 col-lg-12">
					<h2 class="text-center">SEO data for the {{ $data['page_name'] }} page</h2>
					<div class="well">
						<a href="{{ route('seo-home') }}" class="btn btn-primary btn-sm">Back to all pages</a>
					</div>
					<?php
					if ($data)
					{ ?>
						<div class="col-md-12 well">
							<div class="card mt-5 current-data-card">
								<div class="card-header bg-white">
									<h4>
										<i class="fa fa-bullhorn section-title-icon"></i>&nbsp;<span
											class="col-form-label"><b> {{ $data['page_name'] }}</b></span>
									</h4>
									<p class="card-text"><span class="label">Title en</span> {{ $data['meta_title_en'] ?? '---' }}</p>
									<p class="card-text"><span class="label">Title fre</span>{{ $data['meta_title_fre'] ?? '---'}}</p>
									<p class="card-text"><span class="label">Title es</span> {{ $data['meta_title_es'] ?? '---' }}</p>
								</div>

								<div class="card-body">
									<div class="container bg-light p-2">
										<h3>Page specifics></h3>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Meta Description</span>
											</div>

											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['meta_desc_en'] ?? '---' }} br /><hr />
													{{ $data['meta_desc_fre'] ?? '---'}} <br /><hr />
													{{ $data['meta_desc_es'] ?? '---' }} 
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Dynamic (titles & description?)</span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['seo_dynamic'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Meta Keywords</span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['seo_keywords_en'] ?? '---' }}<br /><hr />
													{{ $data['seo_keywords_fre'] ?? '---'}}<br /><hr />
													{{ $data['seo_keywords_es'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title"><small>Canonical link (references another more authoritative page?)</small></span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['canonical_href'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title"><small>No Index (to index or not to index)</small></span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['no_index'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">H1 Text</span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['h1_text_en'] ?? '---' }}<br /><hr />
													{{ $data['h1_text_fre'] ?? '---'}}<br /><hr />
													{{ $data['h1_text_es'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">H2 Text</span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['h2_text_en'] ?? '---' }}<br /><hr />
													{{ $data['h2_text_fre'] ?? '---'}}<br /><hr />
													{{ $data['h2_text_es'] ?? '---' }}
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-2 col-lg-2">
												<span class="font-weight-bold section-title">Page Content</span>
											</div>
											<div class="col-sm-12 col-md-8 col-lg-8">
												<div class="bg-white rounded-top p1-2">
													{{ $data['page_content_en'] ?? '---' }}<br /><hr />
													{{ $data['page_content_fre'] ?? '---'}}<br /><hr />
													{{ $data['page_content_es'] ?? '---' }}
												</div>
											</div>
										</div>


										<h3>Open Graph Settings <small>(Facebook:og tags)</small></h3>
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">OG:title</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_title_en'] ?? '---' }}<br /><hr />
															{{ $data['og_title_fre'] ?? '---'}}<br /><hr />
															{{ $data['og_title_es'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">OG:description</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_desc_en'] ?? '---' }}<br /><hr />
															{{ $data['og_desc_fre'] ?? '---'}}<br /><hr />
															{{ $data['og_desc_es'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">Og:Image</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_image'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">Og:Image width</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_image_width'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">Og:Image height</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_image_height'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">OG:Type <small>e.g. article, profile etc</small></span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_type_en'] ?? '---' }}<br /><hr />
															{{ $data['og_type_fre'] ?? '---'}}<br /><hr />
															{{ $data['og_type_es'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-2 col-lg-2">
														<span class="font-weight-bold section-title">Og:URL <small>The full path to this page</small></span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
															{{ $data['og_url'] ?? '---' }}
														</div>
													</div>
												</div>
											</div>
										</div>

										<h3>Twitter Card settings <small>(Twitter tags)</small></h3>
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Twitter Title</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
														{{ $data['seo_twitter_title_en'] ?? '---' }}<br /><hr />
														{{ $data['seo_twitter_title_fre'] ?? '---'}}<br /><hr />
														{{ $data['seo_twitter_title_es'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Twitter Description</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8">
														<div class="bg-white rounded-top p1-2">
														{{ $data['twitter_desc_en'] ?? '---' }}<br /><hr />
														{{ $data['twitter_desc_fre'] ?? '---'}}<br /><hr />
														{{ $data['twitter_desc_es'] ?? '---' }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12 col-md-4 col-lg-4">
														<span class="font-weight-bold section-title">Twitter Image</span>
													</div>
													<div class="col-sm-12 col-md-8 col-lg-8 ">
														<div class="bg-white rounded-top p1-2">
															{{ $data['seo_twitter_image'] ?? '---' }}
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
													<a type="button" href="{{ route('edit-page-seo', $data['id']) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
													
													<form action="{{ route('delete-page-seo') }}" method="POST" id="deleteForm">
														@csrf
														<input type="hidden" name="pageId" value="{{ $data['id'] }}">
														<a onclick="confirmDelete(event)"
															href="#"
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
								<b>No SEO data was found for that page!</b>
						</p>
						<h3 style="font-weight:bold;color:#3d78d8;">
								<a href="<?=$this->controller->config->getFileRootPath()?>seo" class="btn btn-primary btn-sm">Back to all pages</a>
						</h3>
						<?php
					} ?>	
				</div>
				<!------------------------------------
				MAIN PAGE END
				-------------------------------------->
			</div><!--END OF ROW DIV, THE FIRST ELEMENT INSIDE THE CONTAINER DIV - WH WRAPS AROUND, OR IS FOLLOWED (INSIDE OF IT) BY THE COL-SM-9 DIV THAT HOLDS THE MAIN BODY OF THE PAGE-->
		</div><!--END OF CONTAINER DIV-->
	</section>
@endsection

