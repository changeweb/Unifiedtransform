@extends('layouts.site')

@section('title', 'Alumni - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'alumni-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Alumni</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Alumni</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Alumni Section -->
    <section id="alumni" class="alumni section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="alumni-hero">
          <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
              <div class="hero-content">
                <span class="alumni-badge">Alumni Community</span>
                <h2>Join Our Global Network of Changemakers</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus, velit vel fringilla venenatis, urna risus volutpat nisi, ac commodo dolor nulla quis lorem. In mattis dictum malesuada.</p>
                <div class="alumni-metrics">
                  <div class="metric">
                    <div class="counter">35k+</div>
                    <div class="label">Global Alumni</div>
                  </div>
                  <div class="metric">
                    <div class="counter">142</div>
                    <div class="label">Countries</div>
                  </div>
                  <div class="metric">
                    <div class="counter">76</div>
                    <div class="label">Years of Legacy</div>
                  </div>
                </div>
                <a href="#" class="btn btn-discover">Discover Network Benefits</a>
              </div>
            </div>
            <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="300">
              <div class="hero-image-wrapper">
                <div class="hero-image">
                  <img src="{{ asset('assets/img/education/campus-5.webp') }}" alt="Alumni Network" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="notable-alumni">
          <div class="section-header text-center" data-aos="fade-up" data-aos-delay="200">
            <h3>Notable Alumni Spotlights</h3>
            <p>Extraordinary graduates making an impact in their fields</p>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="alumni-profile">
                <div class="profile-header">
                  <div class="profile-img">
                    <img src="{{ asset('assets/img/person/person-f-3.webp') }}" alt="Alumni" class="img-fluid">
                  </div>
                  <div class="profile-year">2009</div>
                </div>
                <div class="profile-body">
                  <h4>Emma Richardson</h4>
                  <span class="profile-title">Climate Science Researcher</span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis velit a enim tincidunt, sed tincidunt nulla feugiat. Cras efficitur magna in metus lacinia.</p>
                  <a href="#" class="btn-view-profile">View Profile <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="achievement-badge">
                  <i class="bi bi-award"></i>
                  <span>Environmental Leadership Award</span>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="alumni-profile">
                <div class="profile-header">
                  <div class="profile-img">
                    <img src="{{ asset('assets/img/person/person-m-7.webp') }}" alt="Alumni" class="img-fluid">
                  </div>
                  <div class="profile-year">2013</div>
                </div>
                <div class="profile-body">
                  <h4>Dr. Marcus Johnson</h4>
                  <span class="profile-title">Neurosurgeon &amp; Medical Innovator</span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis velit a enim tincidunt, sed tincidunt nulla feugiat. Cras efficitur magna in metus.</p>
                  <a href="#" class="btn-view-profile">View Profile <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="achievement-badge">
                  <i class="bi bi-stars"></i>
                  <span>Medical Innovation Excellence</span>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
              <div class="alumni-profile">
                <div class="profile-header">
                  <div class="profile-img">
                    <img src="{{ asset('assets/img/person/person-f-9.webp') }}" alt="Alumni" class="img-fluid">
                  </div>
                  <div class="profile-year">2015</div>
                </div>
                <div class="profile-body">
                  <h4>Sophia Lin</h4>
                  <span class="profile-title">Tech Entrepreneur &amp; VC Partner</span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas convallis velit a enim tincidunt, sed tincidunt nulla feugiat. Cras efficitur magna in metus.</p>
                  <a href="#" class="btn-view-profile">View Profile <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="achievement-badge">
                  <i class="bi bi-lightning"></i>
                  <span>Tech Visionary of the Year</span>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
            <a href="#" class="btn-explore">Explore More Alumni Stories</a>
          </div>
        </div>

        <div class="alumni-engagement">
          <div class="section-header text-center" data-aos="fade-up" data-aos-delay="200">
            <h3>How to Stay Connected</h3>
            <p>Ways to engage with the community and make a difference</p>
          </div>

          <div class="engagement-cards">
            <div class="row">
              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="engagement-card">
                  <div class="card-icon">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <h4>Mentorship Program</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada.</p>
                  <a href="#" class="card-link">Become a Mentor</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="engagement-card">
                  <div class="card-icon">
                    <i class="bi bi-calendar-event"></i>
                  </div>
                  <h4>Alumni Events</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada.</p>
                  <a href="#" class="card-link">Upcoming Events</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="engagement-card">
                  <div class="card-icon">
                    <i class="bi bi-gift"></i>
                  </div>
                  <h4>Give Back</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada.</p>
                  <a href="#" class="card-link">Support Our Mission</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="engagement-card">
                  <div class="card-icon">
                    <i class="bi bi-briefcase"></i>
                  </div>
                  <h4>Career Network</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada.</p>
                  <a href="#" class="card-link">Join Network</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="upcoming-events">
          <div class="section-header text-center" data-aos="fade-up" data-aos-delay="200">
            <h3>Upcoming Alumni Events</h3>
            <p>Connect with fellow graduates at these exclusive gatherings</p>
          </div>

          <div class="events-wrapper" data-aos="fade-up" data-aos-delay="300">
            <div class="event">
              <div class="date-badge">
                <span class="month">JUN</span>
                <span class="day">18</span>
              </div>
              <div class="event-info">
                <h4>Global Alumni Leadership Summit</h4>
                <div class="event-meta">
                  <span><i class="bi bi-pin-map"></i> Grand Hall, Main Campus</span>
                  <span><i class="bi bi-clock"></i> 10:00 AM - 4:00 PM</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.</p>
              </div>
              <div class="event-action">
                <a href="#" class="btn-register">Register</a>
              </div>
            </div>

            <div class="event">
              <div class="date-badge">
                <span class="month">JUL</span>
                <span class="day">25</span>
              </div>
              <div class="event-info">
                <h4>Networking Mixer &amp; Career Fair</h4>
                <div class="event-meta">
                  <span><i class="bi bi-pin-map"></i> Metropolitan Hotel Conference Center</span>
                  <span><i class="bi bi-clock"></i> 6:30 PM - 9:00 PM</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.</p>
              </div>
              <div class="event-action">
                <a href="#" class="btn-register">Register</a>
              </div>
            </div>

            <div class="event">
              <div class="date-badge">
                <span class="month">SEP</span>
                <span class="day">09</span>
              </div>
              <div class="event-info">
                <h4>Homecoming Weekend 2023</h4>
                <div class="event-meta">
                  <span><i class="bi bi-pin-map"></i> University Campus</span>
                  <span><i class="bi bi-clock"></i> All Weekend</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.</p>
              </div>
              <div class="event-action">
                <a href="#" class="btn-register">Register</a>
              </div>
            </div>
          </div>

          <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
            <a href="#" class="calendar-link">View Full Events Calendar <i class="bi bi-arrow-right-circle"></i></a>
          </div>
        </div>

        <div class="impact-banner" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <div class="impact-content">
                <h3>Make a Lasting Impact</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus, velit vel fringilla venenatis, urna risus volutpat nisi, ac commodo dolor nulla quis lorem. In mattis dictum malesuada. Vestibulum non mi eu justo rutrum tempus.</p>
                <div class="impact-buttons">
                  <a href="#" class="btn-donate">Donate Now</a>
                  <a href="#" class="btn-learn-more">Learn About Impact <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="impact-image">
                <img src="{{ asset('assets/img/education/education-8.webp') }}" alt="Student scholarship recipients" class="img-fluid">
                <div class="impact-stat">
                  <span class="stat-number">$2.4M</span>
                  <span class="stat-text">in scholarships funded by alumni last year</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Alumni Section -->

@endsection
