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
								<li class="breadcrumb-item"><a class="text-white" href="{{ route('seo-home') }}">Seo</a></li>
								<li class="breadcrumb-item text-white active" aria-current="page">Edit Page Seo</li>
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

				<div class="col-sm-12 col-lg-12">
					<h2 style="text-align:center;">Edit SEO data for the '<?=$pageData['page_name'] ?? ''?>' page</h2>
					
					@if ($pageData)
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>
									<i class="fa fa-bullhorn section-title-icon"></i>&nbsp;
									<span class="col-form-label">
										<small>See label text above form fields for hints on how these SEO elements work</small>
									</span>
								</h4>
							</div>
							
							<form id='editPageForm' action="{{ route('save-page-seo-edit') }}" method='POST'>
								@csrf
								<div class="panel-body panel-primary">
									<div class="container bg-light p-2">
										<fieldset>
											<legend>Page specifics</legend>
												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													
													<label for='seo_page_name'>Page Name</label><span id='info'></span>
													<input type='text' id='seo_page_name' name='seo_page_name' 
														class='form-control' value="{{ $pageData['page_name'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title"><small>Meta titles should take a MAX of 60 characters. Try & put in the most important 
														keywords of this page in there. A great tip is to split keywords/phrases/categories/sections (depending on the type of 
														content of this page) by pipe characters e.g. for a car sales details page for a specific car, you can use the pipe 
														technique wisely & pack into this title, vital keywords relating to the category, make, model, plus the actual description of 
														the specific car like so: "Car | Mercedes-Benz | Mercedes G Wagon | Nice car for sale"  
													</small></span>
													
													<label for='seo_meta_title_en'>Title (en)</label>
													<input type='text' id='seo_meta_title_en' name='seo_meta_title_en'
														class='form-control' value="{{ $pageData['meta_title_en'] ?? '---' }}" />

													<label for='seo_meta_title_fre'>Title (fre)</label>
													<input type='text' id='seo_meta_title_fre' name='seo_meta_title_fre'
														class='form-control' value="{{ $pageData['meta_title_fre'] ?? '---' }}" />

													<label for='seo_meta_title_es'>Title (es)</label>
													<input type='text' id='seo_meta_title_es' name='seo_meta_title_es'
														class='form-control' value="{{ $pageData['meta_title_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title"><small>Meta descriptions should take a MAX of 150 characters. Try to get into this 
														section, this page's important keywords. Just like titles, meta descriptions are very powerful SEO influencers. Again, just like 
														with meta titles, you can use the pipe technique here really wisely to pack vital keywords into this description relating to the 
														content of this page. Just make substr_replace you do not literally repeat what is already in the title tag.
													</small></span>
													
													<label for='seo_meta_desc_en'>Meta description (en)</label>
													<input type='text' id='seo_meta_desc_en' name='seo_meta_desc_en'
														class='form-control' value="{{ $pageData['meta_desc_en'] ?? '---' }}" />

													<label for='seo_meta_desc_fre'>Meta description (fre)</label>
													<input type='text' id='seo_meta_desc_fre' name='seo_meta_desc_fre'
														class='form-control' value="{{ $pageData['meta_desc_fre'] ?? '---' }}" />

													<label for='seo_meta_desc_es'>Meta description (es)</label>
													<input type='text' id='seo_meta_desc_es' name='seo_meta_desc_es'
														class='form-control' value="{{ $pageData['meta_desc_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title"><small>By default this is 0 (false), but if it is true, then the page title 
														& description would be dynamically generated from content provided by users & not from the title & decription you 
														create here. You will have to make sure you go into the code of the view file of this page and capture the TITLE & 
														DESCRIPTION text and generate these metatags using the <b>addMetadata()</b> view function and manually pass into it 
														these (title & description) metatags. This is for pages whose title & description data you know will be provided by 
														user-submitted data e.g. a classified ads site. In such a case, you cannot guess what those values will be, so you set 
														'SEO Dynamic' here below to 1.  
													</small></span>
													
													<label for='seo_dynamic'>SEO Dynamic</label>
													<select id='seo_dynamic' name='seo_dynamic' class='form-control'>
														<option value='0'>Select one</option>
														<option value='0' <?=($pageData['dynamic'] == 0) ? "selected='selected'" : '' ?>>0</option>
														<option value='1' <?=($pageData['dynamic'] == 1) ? "selected='selected'" : '' ?>>1</option>
													</select>
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">Meta Keywords</span>
													
													<label for='seo_keywords_en'>Meta keywords (en)</label>
													<input type='text' id='seo_keywords_en' name='seo_keywords_en'
														class='form-control' value="{{ $pageData['keywords_en'] ?? '---' }}" />

													<label for='seo_keywords_fre'>Meta keywords (fre)</label>
													<input type='text' id='seo_keywords_fre' name='seo_keywords_fre'
														class='form-control' value="{{ $pageData['keywords_fre'] ?? '---' }}" />
														
													<label for='seo_keywords_es'>Meta keywords (es)</label>
													<input type='text' id='seo_keywords_es' name='seo_keywords_es'
														class='form-control' value="{{ $pageData['keywords_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">Canonical <small>This is an href link to the main page 
														that has the authority on the content of this page. On a product seach results page, for example; the 
														canonical link will be the link path to the full product catalog page. DGZ will use this link to generate 
														the canonical tag for you. Just provide the full URL path to the target parent page like so:
														'https://yoursite/products/catalog'.	
													</small></span>
													
													<label for='seo_canonical_href'>Canonical link</label>
													<input type='text' id='seo_canonical_href' name='seo_canonical_href'
														class='form-control' value="{{ $pageData['canonical_href'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">No Index (0 or 1)<small>Whether or not you would like this page NOT 
														to be indexed by Search Engines. The default is NO (0) which means all pages are indexed. But if you do not 
														want this page indexed, then just set it to '1'. An example of a page where you would set this to no would be a search 
														results page which makes sense not to index it because the content which will be search result is user-determnined 
														and will always be different. 
													</small></span>
													 
													<label for='seo_no_index'>No index</label>
													<select id='seo_no_index' name='seo_no_index' class='form-control'>
														<option value='0'>Select one</option>
														<option value='0' <?=($pageData['seo_no_index'] == 0) ? "selected='selected'" : '' ?>>0</option>
														<option value='1' <?=($pageData['seo_no_index'] == 1) ? "selected='selected'" : '' ?>>1</option>
													</select>
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">H1 Text. You only need one h1 tag per page. That h1 should describe the 
														content of the page. An h1 tag should contain characters from 20 to a MAX of 70. 
													</span>
													
													<label for='seo_h1_text_en'>H1 Text (en)</label>
													<input type='text' id='seo_h1_text_en' name='seo_h1_text_en'
														class='form-control' value="{{ $pageData['h1_text_en'] ?? '---' }}" />

													<label for='seo_h1_text_fre'>H1 Text (fre)</label>
													<input type='text' id='seo_h1_text_fre' name='seo_h1_text_fre'
														class='form-control' value="{{ $pageData['h1_text_fre'] ?? '--' }}" />

													<label for='seo_h1_text_es'>H1 Text (es)</label>
													<input type='text' id='seo_h1_text_es' name='seo_h1_text_es'
														class='form-control' value="{{ $pageData['h1_text_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">H2 Text</span>
													
													<label for='seo_h2_text_en'>H2 Text (en)</label>
													<input type='text' id='seo_h2_text_en' name='seo_h2_text_en'
														class='form-control' value="{{ $pageData['h2_text_en'] ?? '---' }}" />
													
													<label for='seo_h2_text_fre'>H2 Text (fre)</label>
													<input type='text' id='seo_h2_text_fre' name='seo_h2_text_fre'
														class='form-control' value="{{ $pageData['h2_text_fre'] ?? '---' }}" />
													
													<label for='seo_h2_text_es'>H2 Text (es)</label>
													<input type='text' id='seo_h2_text_es' name='seo_h2_text_es'
														class='form-control' value="{{ $pageData['h2_text_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">Page Content</span>
													
													<label for='seo_page_content_en'>Page content (en)</label>
													<textarea id='seo_page_content_en' name='seo_page_content_en' 
														class ='form-control'>{{ $pageData['page_content_en'] ?? '---' }}</textarea> 

													<label for='seo_page_content_fre'>Page content (fre)</label>
													<textarea id='seo_page_content_fre' name='seo_page_content_fre' 
														class='form-control'>{{ $pageData['page_content_fre'] ?? '---' }}</textarea>

													<label for='seo_page_content_es'>Page content (es)</label>
													<textarea id='seo_page_content_es' name='seo_page_content_es' 
														class='form-control'>{{ $pageData['page_content_es'] ?? '---' }}</textarea>
												</div>
											</fieldset>

											<fieldset>
												<legend>Open Graph Settings <small>(Facebook:og tags)</small></legend>
												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">OG:title. This can be, and is usually the same as the text in 
													your meta title tag. </span>
													
													<label for='seo_og_title_en'>Og title (en)</label>
													<input type='text' id='seo_og_title_en' name='seo_og_title_en'
														class='form-control' value="{{ $pageData['og_title_en'] ?? '---' }}" />

													<label for='seo_og_title_fre'>Og title (fre)</label>
													<input type='text' id='seo_og_title_fre' name='seo_og_title_fre'
														class='form-control' value="{{ $pageData['og_title_fre'] ?? '---' }}" />

													<label for='seo_og_title_es'>Og title (es)</label>
													<input type='text' id='seo_og_title_es' name='seo_og_title_es'
														class='form-control' value="{{ $pageData['og_title_es'] ?? '----' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">OG:description. This can, and is usually the same as the text in 
													your meta desciption. 
													</span>
													
													<label for='seo_og_desc_en'>Og description (en)</label>
													<input type='text' id='seo_og_desc_en' name='seo_og_desc_en'
														class='form-control' value="{{ $pageData['og_desc_en'] ?? '----' }}" />

													<label for='seo_og_desc_fre'>Og description (fre)</label>
													<input type='text' id='seo_og_desc_fre' name='seo_og_desc_fre'
														class='form-control' value="{{ $pageData['og_desc_fre'] ?? '---' }}" />

													<label for='seo_og_desc_es'>Og description (es)</label>
													<input type='text' id='seo_og_desc_es' name='seo_og_desc_es'
														class='form-control' value="{{ $pageData['og_desc_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">
														<small>Facebook image dimensions are 1200 by 630 pixels. You would create and place the image e.g. in your direcxtory 
															system and then provide the fully qualified URL to the image here like so:
															'https://yoursite/assets/images/socials/og-image-img.png'	
															Note: you MUST only provide a secure image path (using 'https') otherwise Facebook will reject it. For security 
															reasons, Facebook only accepts image paths via SSL URLs. 
														</small>
													</span>
													
													<label for='seo_og_image'>Og:Image (Fully qualified image path eg https://yourSite/assets/images/social/og-image.png)</label>
													<input type='text' id='seo_og_image' name='seo_og_image'
														class='form-control' value="{{ $pageData['og_image'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title"><small>Always include the width and height so that FB will render the image 
														with speed.	The recommended width is 1200, stick to it. Only provide the number e.g. 1200, nothing else.
													</small></span>
													
													<label for='seo_og_image_width'>Og:Image width</label>
													<input type='text' id='seo_og_image_width' name='seo_og_image_width' 
														class='form-control' placeholder='recommended: 1200' value="{{ $pageData['og_image_width'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title"><small>Always include the width and height so that FB will render the image 
														with speed. The recommended height is 630, stick to it. Only provide the number e.g. 630, nothing else.
													</small></span>
													
													<label id='seo_og_image_height'>Og:Image height</label>
													<input type='text' id='seo_og_image_height' name='seo_og_image_height' 
														class='form-control' placeholder='recommended: 630' value="{{ $pageData['og_image_height'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">OG:Image secure/SSL link with https 
														<small>e.g. https://yourSite/assets/images/social/image.svg</small></span>
													
													<label for='seo_og_image_secure_url'>Og:Image secure/SSL link</label>
													<input type='text' id='seo_og_image_secure_url' name='seo_og_image_secure_url' 
														class='form-control' value="{{ $pageData['og_image_secure_url'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">OG:Type <small>e.g. article, profile etc</small></span>
													
													<label for='seo_og_type_en'>Og type (en)</label>
													<input type='text' id='seo_og_type_en' name='seo_og_type_en'
														class='form-control' value="{{ $pageData['og_type_en'] ?? '---' }}" />
													
													<label for='seo_og_type_fre'>Og type (fre)</label>
													<input type='text' id='seo_og_type_fre' name='seo_og_type_fre'
														class='form-control' value="{{ $pageData['og_type_fre'] ?? '---' }}" />
													
													<label for='seo_og_type_es'>Og type (es)</label>
													<input type='text' id='seo_og_type_es' name='seo_og_type_es'
														class='form-control' value="{{ $pageData['og_type_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													
													<label for='seo_og_url'>Og:URL (The full path to this page)</label>
													<input type='text' id='seo_og_url' name='seo_og_url' 
														class='form-control' value="{{ $pageData['og_url'] ?? '---' }}" /> 
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group"> 
													<span class="font-weight-bold section-title">
														<small>Fully qualified URL path to a video if there is one, for the content of this page</small></span>
													
													<label for='seo_og_video'>Og:video (e.g. https://yoursite/assets/videos/myVideo.mp4)</label>
													<input type='text' id='seo_og_video' name='seo_og_video' 
														class='form-control' value="{{ $pageData['og_video'] ?? '---' }}" /> 
												</div>
											</fieldset>	

											<fieldset>
												<legend>Twitter Card settings <small>(Twitter tags)</small></legend>
												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">Twitter Title. This can be, and is usually the same as the text in 
													your meta title tag. </span>
													
													<label for='seo_twitter_title_en'>Twitter Title (en)</label>
													<input type='text' id='seo_twitter_title_en' name='seo_twitter_title_en'
														class='form-control' value="{{ $pageData['twitter_title_en'] ?? '---' }}" />

													<label for='seo_twitter_title_fre'>Twitter Title (fre)</label>
													<input type='text' id='seo_twitter_title_fre' name='seo_twitter_title_fre'
														class='form-control' value="{{ $pageData['twitter_title_fre'] ?? '---' }}" />

													<label for='seo_twitter_title_es'>Twitter Title (es)</label>
													<input type='text' id='seo_twitter_title_es' name='seo_twitter_title_es'
														class='form-control' value="{{ $pageData['twitter_title_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">Twitter Description. This can be, and is usually the same as the text in 
													your meta desciption. </span>
													
													<label for='seo_twitter_desc_en'>Twitter description (en)</label>
													<input type='text' id='seo_twitter_desc_en' name='seo_twitter_desc_en'
														class='form-control' value="{{ $pageData['twitter_desc_en'] ?? '---' }}" />

													<label for='seo_twitter_desc_fre'>Twitter description (fre)</label>
													<input type='text' id='seo_twitter_desc_fre' name='seo_twitter_desc_fre'
														class='form-control' value="{{ $pageData['twitter_desc_fre'] ?? '---' }}" />

													<label for='seo_twitter_desc_es'>Twitter description (es)</label>
													<input type='text' id='seo_twitter_desc_es' name='seo_twitter_desc_es'
														class='form-control' value="{{ $pageData['twitter_desc_es'] ?? '---' }}" />
												</div>

												<div class="col-sm-12 col-md-12 col-lg-12 form-group">
													<span class="font-weight-bold section-title">
														<small>You do not really need images for twitter because Twitter's search engine bots will 
															default to Open Graph (og:metatags) if they cannot find Twitter Cards. However, bear in mind that 
															an OG image does not fit perfectly within a tweet, so content can get cut off. To be on the safe 
															side, create a separate image for the Twitter Card image. Twitter Card image dimensions are 
															1024 by 512 pixels. You would create and place the image e.g. in your direcxtory system and 
															provide the fully qualified URL to the image here like so:
															'https://yoursite/assets/images/socials/twitter-page-img.png'	
															Note: you MUST only provide a secure image path (using 'https') otherwise it will be ignored. 
														</small>
													</span>
													
													<label for='seo_twitter_image'>Twitter Image</label>
													<input type='text' id='seo_twitter_image' name='seo_twitter_image' 
														class='form-control' value="{{ $pageData['twitter_image'] ?? '---' }}" /> 
												</div>
											</fieldset>
										</div>
									</div>
									<div class="panel-footer">
										<div class="form-group">
											
											<input type='hidden' id='seo_id' name='seo_id' value="{{ $pageData['id'] }}">
											<a href="{{ route('seo-home') }}" class='btn btn-warning btn-sm'>Cancel</a>
											<input type='submit' value='Save Changes' class='btn btn-primary btn-sm ml-3' />
										</div>		
									</div>		
								</div>
							</form>
						</div>
					@else 
						<p style="color:red;text-align: center;">
								<b>Page SEO data not found!</b>
						</p>
						<h3 style="font-weight:bold;color:#3d78d8;">
								<a href="{{ route('seo-home') }}" class="btn btn-primary btn-sm">Return to Seo page</a>
						</h3>
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- ==========================
		PAGE CONTENT - END
	=========================== -->
@endsection
