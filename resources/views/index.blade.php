@extends('layouts.main.app')

@section('content')

    <!-- ==========================
    BREADCRUMB - START
    =========================== -->
    <!-- Hero Header Start -->
    <div class="container-xxl py-5 bg-primary hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="col-12 text-center">
                    <h1 class="text-white animated zoomIn">SEO</h1>
                    <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">SEO</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Header End -->
    <!-- ==========================
        BREADCRUMB - END
    =========================== -->



    <!-- ==========================
        PAGE CONTENT - START
    =========================== -->
    <?php 
    $globalRecordCount = (count($globalDataSet) ? count($globalDataSet) : '');
    $pageCount = (count($seoData) ? count($seoData) : ''); 
    ?>
    <section class="content news">
		<div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 style="text-align:center;">Welcome to the Typhoon SEO module</h1>
                    <h4 class="text-center"><b>Super-charge the SEO efforts of your web application</b></h4>

                    <h3>
                        <i class="fa fa-bullhorn section-title-icon"></i>&nbsp;<span
                            class="col-form-label"><b>Global SEO Settings (<?=$globalRecordCount?>)</b></span>
                    </h3>
                    <div class="well">
                    <a href="{{ route('add-global-seo') }}" class="btn btn-primary btn-sm">Create Global data</a>
                    <h5 class="text-center"><b>Note: </b>You may have multiple global sets, but only the first in the list will ever be used</h5>
                    </div>
                    <?php
                    if ($globalDataSet)
                    { ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Record ID</th>
                                    <th scope="col">Place</th>
                                    <th scope="col">Region</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div class="list-group list-group-horizontal">
                                        @foreach ($globalDataSet as $globalData) 
                                            <tr>
                                                <a href="">
                                                    <td>{{ $globalData.seo_global_id }}</td>
                                                    <td>{{ $globalData.seo_global_geo_placename }}</td>
                                                    <td>{{ $globalData.seo_global_geo_region }}</td>
                                                    <td>
                                                        <a class="clickable-record" 
                                                            title="View Global SEO Data" 
                                                            href="{{ route('edit-gloal-seo', $globalData.seo_global_id) }}"><i 
                                                            class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </a>
                                            </tr> 
                                        @endforeach
                                    </div>	
                                </tbody>
                            </table> 
                        </div>
                    <?php
                    } ?>	
                        
                    <br />
                    <hr />

                    <h3>
                        <i class="fa fa-bullhorn section-title-icon"></i>&nbsp;<span
                            class="col-form-label"><b>Pages SEO Data (<?=$pageCount?>)</b></span>
                    </h3>
                    <div class="well">
                        <a href="{{ route('add-page-seo') }}" class="btn btn-primary btn-sm">Create page data</a>
                    </div>
                    @if ($seoData)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Page name</th>
                                    <th scope="col">Title</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div class="list-group list-group-horizontal">
                                        @foreach ($seoData as $sdata) 
                                            <tr>
                                                <a href="">
                                                    <td>{{ $sdata.seo_page_name }}</td>
                                                    <td>{{ $sdata.seo_meta_title_en }}</td>
                                                    <td>
                                                        <a class="clickable-record" 
                                                            title="View Page SEO Data" 
                                                            href="{{ route('page-detail', $sdata.seo_id) }}"><i 
                                                            class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </a>
                                            </tr> 
                                        @endforeach
                                    </div>	
                                </tbody>
                            </table> 
                        </div>
                    @else 
                        <p style="color:red;text-align: center;">
                                <b>There is no SEO data for your site pages yet!</b>
                        </p>
                        <h3 style="font-weight:bold;color:#3d78d8;">
                                <a href="{{ route('add-page-seo') }}" class="btn btn-primary btn-sm">Create page data</a>
                        </h3>
                    @endif	
                </div>
            </div>
		</div>
	</section>
    @endsection