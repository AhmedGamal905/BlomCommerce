<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Dashboard</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/public/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/public/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/public/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard/public/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('dashboard/public/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('dashboard/public/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('dashboard/public/assets/js/config.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/simplebar/simplebar.min.js') }}"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('dashboard/public/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/public/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/public/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/public/vendors/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/public/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/public/assets/css/theme-rtl.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('dashboard/public/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashboard/public/assets/css/user-rtl.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('dashboard/public/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">

                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

                    </div><a class="navbar-brand" href="{{ route('products.index') }}">
                        <div class="d-flex align-items-center py-3"><img class="me-2" src="{{ asset('dashboard/public/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" /><span class="font-sans-serif text-primary">falcon</span>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <li class="nav-item">
                                <ul class="nav collapse show" id="e-commerce">
                                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#product" data-bs-toggle="collapse" aria-expanded="true" aria-controls="e-commerce">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Categories</span>
                                            </div>
                                        </a>
                                        @forelse ($shareCategories as $category)
                                        <ul class="nav collapse show" id="product">
                                            <li class="nav-item"><a class="nav-link" href="{{ route('products.index', ['category_id' => $category->id]) }}">
                                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">{{$category->title}}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        @empty
                                        <p>No categories found.</p>
                                        @endforelse
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.show')}}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Cart</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Orders</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="../../../index.html">
                        <div class="d-flex align-items-center"><img class="me-2" src="{{ asset('dashboard/public/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" /><span class="font-sans-serif text-primary">falcon</span>
                        </div>
                    </a>
                    <ul class="navbar-nav align-items-center d-none d-lg-block">
                        <li class="nav-item">
                            <div class="search-box" data-list='{"valueNames":["title"]}'>
                                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                    <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search" />
                                    <span class="fas fa-search search-box-icon"></span>

                                </form>
                                <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none" data-bs-dismiss="search">
                                    <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                        <li class="nav-item ps-2 pe-0">
                            <div class="dropdown theme-control-dropdown">
                                <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0" href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span>
                                    <span class="fas fa-moon fs-7" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></span>
                                    <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="light" data-theme-control="theme">
                                            <span class="fas fa-sun"></span> Light
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme">
                                            <span class="fas fa-moon" data-fa-transform=""></span> Dark
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme">
                                            <span class="fas fa-adjust" data-fa-transform=""></span> Auto
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="{{ asset('dashboard/public/assets/img/team/3-thumb.png') }}" alt="" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <form method="get" action="{{ route('profile.edit') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Profile</button>
                                    </form>
                                </div>
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @else
                        <li>
                            <div class="d-flex">
                                <form action="{{ route('login') }}" method="GET">
                                    <button class="btn btn-primary me-1 mb-1" type="submit">Login</button>
                                </form>
                                @if (Route::has('register'))
                                <form action="{{ route('register') }}" method="GET">
                                    <button class="btn btn-success me-1 mb-1" type="submit">Register</button>
                                </form>
                                @endif
                            </div>
                        </li>
                        @endauth
                        @endif
                    </ul>
                </nav>

                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2024 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v3.20.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('dashboard/public/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('dashboard/public/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('dashboard/public/assets/js/theme.js') }}"></script>

</body>

</html>