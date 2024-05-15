
    <header class="navbar navbar-transparent navbar-fixed-top">
        <div class="container">
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">&nbsp;&nbsp; Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="{{ url('/') }}" class="navbar-brand p-0">
                    <h1 class="m-0">Test<span class="fs-9">Project</span></h1><!--It was 'fs-5'-->
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>

                <button onclick="toggleSlideMenu(event)" type="button" class="navbar-toggler" data-bs-toggle="collapse">
                    <span class="fa fa-bars"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link active"><i class="fa fa-home"></i>Home</a>
                        <a href="#" class="nav-item nav-link">Contact</a>
                        @if(Auth::check())
                            
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">
                                    <i class="fa fa-user"></i> {{ Auth::user()->firstname }}</a>

                                <div class="dropdown-menu m-0">
                                    <a href="#" class="nav-item nav-link">Dashboard</a>
                                    <a href="#" class="nav-item nav-link">
                                        <i class="fa fa-envelope-o"></i>Contact Messages</a>
                                    <form method="POST" action="#">
                                        @csrf
                                        <!--<a href="#" class="nav-item nav-link">Logout</a>-->
                                        <button type="submit" class="btn nav-item nav-link">Logout</button>
                                    </form> 
                                </div>
                            </div>

                        @else
                        <a href="#" class="nav-item nav-link">Login</a>
                        <?php
                            if (config('app.allow_registration') === true)
                            { ?>
                            <a href="#" type="button"  class="nav-item nav-link">Register</a>
                            <?php
                            } ?>
                        @endif
                    </div>
                    <butaton type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                </div>
            </nav>

            <?php
            //list($controller, $method) = $this->config->getCurrentRoute();
            ?>
            <?php //<!--------------------------------------- FULL SITE SEARCH FORM -------------------------------------------------------> */?>
                    <div class="modal fade" id="searchModal" tabindex="-1">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                                <form method="get" action="#">


                                    <div class="modal-header border-0">
                                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body d-flex align-items-center justify-content-center">
                                        <div class="input-group" style="max-width: 600px;">
                                            <input type="text" name="search_keyword" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                                            <button type="submit" class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>

                                    <!--We send the current controller with this form, so the system knows which view the user searched from
                                            as this search form is available every where on the site-->
                                    <?php /*<input type="hidden" name="searchOrigin" value="<?=$controller?>/<?=$method?>" /> */?>
                                    <input type="hidden" name="searchOrigin" value="{{ Route::currentRouteName() }}" />
                                </form>

                            </div>
                        </div>
                    </div>
            <?php //<!----------------------------------END SITE SEARCH FORM----------------------------------------------------------------------------------> */?>
        </div>

        </div>
      </div>
    </header>

    <script type="application/javascript">
        function toggleSlideMenu(e) {
            e.preventDefault();
            const sideMenu = document.querySelector('#side-menu');
            const sideMenuStyle = window.getComputedStyle(sideMenu);

            document.getElementById('side-menu').style.width = sideMenuStyle.width === '250px' ? '0' : '250px';
            document.getElementById('side-menu').style.display = sideMenuStyle.display === 'none' ? 'block' : 'none';
        }

        function closeSlideMenu(e) {
            e.preventDefault();
            document.getElementById('side-menu').style.width = '0';
            document.getElementById('side-menu').style.display = 'none';
        }
    </script> 
