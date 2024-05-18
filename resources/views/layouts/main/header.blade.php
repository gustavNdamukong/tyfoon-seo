
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
                    <h1 class="m-0">Tyfoon<span class="fs-9">Seo</span></h1>
                </a>

                <button onclick="toggleSlideMenu(event)" type="button" class="navbar-toggler" data-bs-toggle="collapse">
                    <span class="fa fa-bars"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#" class="nav-item nav-link active"><i class="fa fa-home"></i>Home</a>
                        <a href="#" class="nav-item nav-link">Some link</a>
                        <a href="#" class="nav-item nav-link">Link</a>
                        <a href="#" type="button"  class="nav-item nav-link">Another link</a>
                    </div>
                </div>
            </nav>
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
