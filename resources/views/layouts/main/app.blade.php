<?php /*
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @yield('top-scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @yield('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('bottom-scripts')
</body>
</html>*/ ?>








<!--============================= LAYOUT START =============================================-->
<!DOCTYPE HTML>
		<html class="no-js" lang="en-gb" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
		<head>
			<!-- ==========================
                    Meta Tags
                =========================== -->
                <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
			<?php //$this->getGlobalSeoData() ?? '' ?>
            <?php //($this->getMetadata() != null) ? $this->getMetadata() : "<title>".self::$appName."-".$this->pageTitle."</title>" ?>

			<title>{{ config('app.name', 'No config app name') }}</title>

			<!-- Google Web Fonts -->
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

			<!-- Icon Font Stylesheet -->
			<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">-->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
			<link href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">



			<!-- Scripts -->
			@yield('top-scripts')
			<?php /*<script src="{{ asset('js/app.js') }}" defer></script> 
			//example of how you would include js files at page top if u chose to. Notice the 'defer' attr which
			//makes sure your HTML is fully loaded b4 this script is attempted to be run. This has same effect as when
			//you place your scripts at the bottom of your html body section */ ?>

            <!-- Styles -->
			<?php // $this->getCssHtml() ?>
            @yield('styles')
            <?php /*include('html_dependencies_top.inc.php'); */ ?>
            @include('layouts.main.html_dependencies_top')
            <?php /*<link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
			// this is an example of how to link stylesheets */ ?>
		</head>
		<body>

		<!-- ==========================
            SCROLL TOP - START
        =========================== -->
		<div id="scrolltop" class="hidden-xs"><i class="fa fa-angle-up"></i></div>
		<!-- ==========================
            SCROLL TOP - END
        =========================== -->

		<div id="page-wrapper" class="bg-white"> <!-- PAGE - START -->

			  <!-- ==========================
				  HEADER - START
			  =========================== -->
			  <?php //include('header.inc.php'); ?>
			  @include('layouts.main.header')
			  <!-- ==========================
				  HEADER - END
			  =========================== -->

			  <?php /*
			  if(!empty($this->exceptions)):
				  ?>
				  <div class="alert exceptions text-center" role="alert" style="margin-top: 10%;">
					  <?= $this->exceptions ?>
				  </div>
				  <?php
			  endif;
			  if(!empty($this->warnings)):
				  ?>
				  <div class="alert warnings text-center" role="alert" style="margin-top: 10%;">
					  <?= $this->warnings ?>
				  </div>
				  <?php
			  endif;
			  if(!empty($this->errors)):
				  ?>
				  <div class="alert danger text-center" role="alert" style="margin-top: 10%;">
					  <?= $this->errors ?>
				  </div>
				  <?php
			  endif;
			  if(!empty($this->notices)):
				  ?>
				  <div class="alert notices text-center" role="alert" style="margin-top: 10%;">
					  <?= $this->notices ?>
				  </div>
				  <?php
			  endif;
			  if(!empty($this->successes)):
				  ?>
				  <div class="alert success text-center" role="alert" style="margin-top: 10%;">
					  <?= $this->successes ?>
				  </div>
				  <?php
			  endif; */
			  ?>


			<!-- ==========================
			  PAGE CONTENT - START
		    =========================== -->
			@yield('content')
			<!-- ==========================
			  PAGE CONTENT - END
			=========================== -->


			<section>
				<div class="well">
					<div id="consent-popup" class="consent-hidden">
						<p>Be aware that we use cookies to improve your experience, and nothing more <a href="#"> Link to your Terms & Conditions or Data Policy here</a>.
							<a href="#" id="accept-cookie-use" class="btn btn-primary rounded-pill animated slidInRight">Okay</a>
						</p>
					</div>
					<!-- ==========================
						  FOOTER - START
					  =========================== -->
					<?php //include('footer.inc.php'); ?>
					@include('layouts.main.footer')
					<!-- ==========================
						FOOTER - END
					=========================== -->
				</div>
			</section>

		</div> <!-- Page wrapper div - END -->

        <!-- Scripts -->
        @yield('bottom-scripts')
        <?php //<script src="{{ asset('js/app.js') }}" defer></script>
		//example of how you would include js files at the bottom of the page ?>
		<?php //include('html_dependencies_bottom.inc.php'); ?>
		@include('layouts.main.html_dependencies_bottom')
		<!-- Include custom scripts meant for individual views -->
		<?php // $this->getJavascriptHtml() ?>

		</body>
		</html>
<!--=============================== LAYOUT END ============================================-->