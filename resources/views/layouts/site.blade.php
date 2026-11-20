<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', config('app.name', 'KWONG CHOW SCHOOL'))</title>
  <meta name="description" content="@yield('meta_description', '')">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}?v=2">
  <link rel="shortcut icon" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}?v=2">
  <link rel="shortcut icon" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}?v=2">
  <link rel="apple-touch-icon" href="{{ asset('favicon_io/apple-touch-icon.png') }}?v=2">
  <link rel="icon" href="{{ asset('favicon_io/android-chrome-192x192.png') }}?v=2" sizes="192x192">
  <link rel="icon" href="{{ asset('favicon_io/android-chrome-512x512.png') }}?v=2" sizes="512x512">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  @stack('styles')

  <!-- =======================================================
  * Template Name: NiceSchool
  * Template URL: https://bootstrapmade.com/nice-school-bootstrap-education-template/
  * Updated: May 10 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="@yield('body-class', 'index-page')">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('imgs/kcs-logo.png') }}" alt="{{ config('app.name') }}">
        <h1 class="sitename">{{ config('app.name', 'KWONG CHOW SCHOOL') }}</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
          <li class="dropdown"><a href="{{ route('about') }}"><span>About</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
              <li><a href="{{ route('admissions') }}" class="{{ request()->routeIs('admissions') ? 'active' : '' }}">Admissions</a></li>
              <li><a href="{{ route('academics') }}" class="{{ request()->routeIs('academics') ? 'active' : '' }}">Academics</a></li>
              <li><a href="{{ route('faculty-staff') }}" class="{{ request()->routeIs('faculty-staff') ? 'active' : '' }}">Faculty &amp; Staff</a></li>
              <li><a href="{{ route('campus-facilities') }}" class="{{ request()->routeIs('campus-facilities') ? 'active' : '' }}">Campus &amp; Facilities</a></li>
            </ul>
          </li>

          <li><a href="{{ route('students-life') }}" class="{{ request()->routeIs('students-life') ? 'active' : '' }}">Students Life</a></li>
          <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news') ? 'active' : '' }}">News</a></li>
          <li><a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">Events</a></li>
          <li><a href="{{ route('alumni') }}" class="{{ request()->routeIs('alumni') ? 'active' : '' }}">Alumni</a></li>
          <li class="dropdown"><a href="#"><span>More Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('news-details') }}" class="{{ request()->routeIs('news-details') ? 'active' : '' }}">News Details</a></li>
              <li><a href="{{ route('event-details') }}" class="{{ request()->routeIs('event-details') ? 'active' : '' }}">Event Details</a></li>
              <li><a href="{{ route('privacy') }}" class="{{ request()->routeIs('privacy') ? 'active' : '' }}">Privacy</a></li>
              <li><a href="{{ route('terms-of-service') }}" class="{{ request()->routeIs('terms-of-service') ? 'active' : '' }}">Terms of Service</a></li>
              <li><a href="{{ route('starter-page') }}" class="{{ request()->routeIs('starter-page') ? 'active' : '' }}">Starter Page</a></li>
            </ul>
          </li>
          <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
          @auth
            <li><a href="{{ url('/home') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
          @else
            <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Portal Login</a></li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    @yield('content')
  </main>

  <footer id="footer" class="footer position-relative dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('imgs/kcs-logo.png') }}" height="40" class="me-2" alt="{{ config('app.name') }}">
            <span class="sitename">{{ config('app.name', 'KWONG CHOW SCHOOL') }}</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About us</a></li>
            <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
            <li><a href="{{ route('terms-of-service') }}">Terms of service</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Academics</h4>
          <ul>
            <li><a href="{{ route('academics') }}">Academics</a></li>
            <li><a href="{{ route('admissions') }}">Admissions</a></li>
            <li><a href="{{ route('faculty-staff') }}">Faculty &amp; Staff</a></li>
            <li><a href="{{ route('students-life') }}">Students Life</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Community</h4>
          <ul>
            <li><a href="{{ route('news') }}">News</a></li>
            <li><a href="{{ route('events') }}">Events</a></li>
            <li><a href="{{ route('alumni') }}">Alumni</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Portal</h4>
          <ul>
            @auth
              <li><a href="{{ url('/home') }}">Dashboard</a></li>
            @else
              <li><a href="{{ route('login') }}">Portal Login</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name', 'KWONG CHOW SCHOOL') }}</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')

</body>

</html>
