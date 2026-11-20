@extends('layouts.site')

@section('title', 'Campus Facilities - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'campus-facilities-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Campus &amp; Facilities</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Campus Facilities</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Campus Facilities Section -->
    <section id="campus-facilities" class="campus-facilities section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Introduction -->
        <div class="intro-row">
          <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
              <div class="intro-content">
                <h2 class="fw-bold">Experience Our Campus</h2>
                <p class="lead">Discover state-of-the-art facilities designed to inspire learning and growth</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque magna vitae eros faucibus, vitae finibus massa pharetra. Nullam egestas dolor in condimentum faucibus.</p>
                <div class="stats-container">
                  <div class="stat-item">
                    <span class="stat-number">120+</span>
                    <span class="stat-label">Acres</span>
                  </div>
                  <div class="stat-item">
                    <span class="stat-number">45</span>
                    <span class="stat-label">Buildings</span>
                  </div>
                  <div class="stat-item">
                    <span class="stat-number">15k+</span>
                    <span class="stat-label">Students</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
              <div class="intro-image-container">
                <div class="intro-image main-image">
                  <img src="{{ asset('assets/img/education/campus-1.webp') }}" alt="Main Campus" class="img-fluid rounded">
                </div>
                <div class="intro-image accent-image">
                  <img src="{{ asset('assets/img/education/campus-2.webp') }}" alt="Campus Feature" class="img-fluid rounded">
                </div>
                <div class="tour-button">
                  <a href="#" class="btn-tour"><i class="bi bi-play-circle-fill"></i> Virtual Tour</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Facilities Tabs -->
        <div class="facilities-tabs" data-aos="fade-up" data-aos-delay="200">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="academic-tab" data-bs-toggle="tab" data-bs-target="#campus-facilities-academic" type="button" role="tab">
                <i class="bi bi-book"></i> Academic
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="athletic-tab" data-bs-toggle="tab" data-bs-target="#campus-facilities-athletic" type="button" role="tab">
                <i class="bi bi-trophy"></i> Athletic
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="residential-tab" data-bs-toggle="tab" data-bs-target="#campus-facilities-residential" type="button" role="tab">
                <i class="bi bi-house-door"></i> Residential
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="community-tab" data-bs-toggle="tab" data-bs-target="#campus-facilities-community" type="button" role="tab">
                <i class="bi bi-people"></i> Community
              </button>
            </li>
          </ul>

          <div class="tab-content">
            <!-- Academic Facilities Tab -->
            <div class="tab-pane fade show active" id="campus-facilities-academic" role="tabpanel">
              <div class="row gy-4">
                <div class="col-md-7" data-aos="fade-right" data-aos-delay="100">
                  <div class="facility-highlight">
                    <div class="facility-slider">
                      <div class="facility-slide">
                        <img src="{{ asset('assets/img/education/campus-3.webp') }}" alt="Library" class="img-fluid rounded">
                        <div class="slide-caption">Central Library</div>
                      </div>
                    </div>
                    <div class="facility-description">
                      <h3>World-Class Learning Spaces</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam gravida luctus urna, vel efficitur purus faucibus vitae. Sed interdum ligula eu metus tempor dapibus.</p>
                      <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Modern classrooms with smart technology</li>
                        <li><i class="bi bi-check-circle-fill"></i> Specialized research laboratories</li>
                        <li><i class="bi bi-check-circle-fill"></i> Collaborative study spaces</li>
                        <li><i class="bi bi-check-circle-fill"></i> Advanced technology centers</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-5" data-aos="fade-left" data-aos-delay="200">
                  <div class="facility-cards">
                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-laptop"></i>
                      </div>
                      <h4>Technology Labs</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 24 Labs</span>
                    </div>

                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-flask"></i>
                      </div>
                      <h4>Research Centers</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 42 Facilities</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Athletic Facilities Tab -->
            <div class="tab-pane fade" id="campus-facilities-athletic" role="tabpanel">
              <div class="row gy-4">
                <div class="col-md-7" data-aos="fade-right" data-aos-delay="100">
                  <div class="facility-highlight">
                    <div class="facility-slider">
                      <div class="facility-slide">
                        <img src="{{ asset('assets/img/education/campus-5.webp') }}" alt="Athletic Center" class="img-fluid rounded">
                        <div class="slide-caption">Sports Complex</div>
                      </div>
                    </div>
                    <div class="facility-description">
                      <h3>State-of-the-Art Athletic Facilities</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam gravida luctus urna, vel efficitur purus faucibus vitae. Sed interdum ligula eu metus tempor dapibus.</p>
                      <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Olympic-sized swimming pool</li>
                        <li><i class="bi bi-check-circle-fill"></i> Multi-purpose sports courts</li>
                        <li><i class="bi bi-check-circle-fill"></i> Professional running track</li>
                        <li><i class="bi bi-check-circle-fill"></i> Fitness and training centers</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-5" data-aos="fade-left" data-aos-delay="200">
                  <div class="facility-cards">
                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-water"></i>
                      </div>
                      <h4>Aquatic Center</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> Olympic Standard</span>
                    </div>

                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-stopwatch"></i>
                      </div>
                      <h4>Training Facilities</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> Pro Equipment</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Residential Facilities Tab -->
            <div class="tab-pane fade" id="campus-facilities-residential" role="tabpanel">
              <div class="row gy-4">
                <div class="col-md-7" data-aos="fade-right" data-aos-delay="100">
                  <div class="facility-highlight">
                    <div class="facility-slider">
                      <div class="facility-slide">
                        <img src="{{ asset('assets/img/education/campus-7.webp') }}" alt="Residence Hall" class="img-fluid rounded">
                        <div class="slide-caption">Residence Halls</div>
                      </div>
                    </div>
                    <div class="facility-description">
                      <h3>Comfortable Living Environments</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam gravida luctus urna, vel efficitur purus faucibus vitae. Sed interdum ligula eu metus tempor dapibus.</p>
                      <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Modern residence halls</li>
                        <li><i class="bi bi-check-circle-fill"></i> Suite-style accommodations</li>
                        <li><i class="bi bi-check-circle-fill"></i> Community lounges and kitchens</li>
                        <li><i class="bi bi-check-circle-fill"></i> 24/7 security and support</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-5" data-aos="fade-left" data-aos-delay="200">
                  <div class="facility-cards">
                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-cup-hot"></i>
                      </div>
                      <h4>Dining Facilities</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 5 Locations</span>
                    </div>

                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-shield-check"></i>
                      </div>
                      <h4>Security Services</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 24/7 Support</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Community Facilities Tab -->
            <div class="tab-pane fade" id="campus-facilities-community" role="tabpanel">
              <div class="row gy-4">
                <div class="col-md-7" data-aos="fade-right" data-aos-delay="100">
                  <div class="facility-highlight">
                    <div class="facility-slider">
                      <div class="facility-slide">
                        <img src="{{ asset('assets/img/education/campus-4.webp') }}" alt="Student Center" class="img-fluid rounded">
                        <div class="slide-caption">Student Center</div>
                      </div>
                    </div>
                    <div class="facility-description">
                      <h3>Vibrant Community Spaces</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam gravida luctus urna, vel efficitur purus faucibus vitae. Sed interdum ligula eu metus tempor dapibus.</p>
                      <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> Student activity center</li>
                        <li><i class="bi bi-check-circle-fill"></i> Art galleries and theaters</li>
                        <li><i class="bi bi-check-circle-fill"></i> Green spaces and gardens</li>
                        <li><i class="bi bi-check-circle-fill"></i> Meeting and event venues</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-5" data-aos="fade-left" data-aos-delay="200">
                  <div class="facility-cards">
                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-music-note-beamed"></i>
                      </div>
                      <h4>Performance Spaces</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 3 Venues</span>
                    </div>

                    <div class="facility-card">
                      <div class="icon-container">
                        <i class="bi bi-shop"></i>
                      </div>
                      <h4>Campus Stores</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vestibulum ante vel magna convallis.</p>
                      <span class="info-badge"><i class="bi bi-info-circle"></i> 8 Locations</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Campus Gallery -->
        <div class="campus-gallery-section" data-aos="fade-up" data-aos-delay="300">

          <div class="gallery-grid">
            <div class="gallery-item large" data-aos="zoom-in" data-aos-delay="100">
              <img src="{{ asset('assets/img/education/campus-3.webp') }}" alt="Library" class="img-fluid" loading="lazy">
              <div class="gallery-overlay">
                <h4>Central Library</h4>
              </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
              <img src="{{ asset('assets/img/education/campus-8.webp') }}" alt="Student Center" class="img-fluid" loading="lazy">
              <div class="gallery-overlay">
                <h4>Student Center</h4>
              </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
              <img src="{{ asset('assets/img/education/campus-9.webp') }}" alt="Dormitory" class="img-fluid" loading="lazy">
              <div class="gallery-overlay">
                <h4>Dormitories</h4>
              </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="400">
              <img src="{{ asset('assets/img/education/campus-10.webp') }}" alt="Study Areas" class="img-fluid" loading="lazy">
              <div class="gallery-overlay">
                <h4>Study Areas</h4>
              </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="500">
              <img src="{{ asset('assets/img/education/campus-5.webp') }}" alt="Sports Complex" class="img-fluid" loading="lazy">
              <div class="gallery-overlay">
                <h4>Sports Complex</h4>
              </div>
            </div>
          </div>
        </div>

        <!-- Campus Map -->
        <div class="campus-map-section" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
              <div class="map-info">
                <h2>Campus Map</h2>
                <p>Navigate our expansive campus with ease using our interactive map. Locate buildings, facilities, and services to find your way around.</p>
                <div class="map-legend">
                  <div class="legend-item">
                    <span class="marker academic"></span>
                    <span>Academic Buildings</span>
                  </div>
                  <div class="legend-item">
                    <span class="marker residential"></span>
                    <span>Residence Halls</span>
                  </div>
                  <div class="legend-item">
                    <span class="marker athletic"></span>
                    <span>Athletic Facilities</span>
                  </div>
                  <div class="legend-item">
                    <span class="marker dining"></span>
                    <span>Dining Facilities</span>
                  </div>
                  <div class="legend-item">
                    <span class="marker parking"></span>
                    <span>Parking Areas</span>
                  </div>
                </div>
                <a href="#" class="btn-map"><i class="bi bi-download"></i> Download PDF Map</a>
              </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
              <div class="map-container">
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.142047033408!2d-73.96257908469264!3d40.8026564793159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f7a00e3ea009%3A0x4e63c3c3d93908b5!2sColumbia%20University!5e0!3m2!1sen!2sus!4v1625598195750!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Campus Facilities Section -->

@endsection
