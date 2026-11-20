@extends('layouts.site')

@section('title', 'About - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'about-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>About</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">About</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- History Section -->
    <section id="history" class="history section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <div class="about-content" data-aos="fade-up" data-aos-delay="200">
              <h3>Our Story</h3>
              <h2>Educating Minds, Inspiring Hearts</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae odio ac nisi tristique venenatis. Nullam feugiat ipsum vitae justo finibus, in sagittis dolor malesuada. Aenean vel fringilla est, a vulputate massa.</p>

              <div class="timeline">
                <div class="timeline-item">
                  <div class="timeline-dot"></div>
                  <div class="timeline-content">
                    <h4>1965</h4>
                    <p>Etiam at tincidunt arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                  </div>
                </div>

                <div class="timeline-item">
                  <div class="timeline-dot"></div>
                  <div class="timeline-content">
                    <h4>1982</h4>
                    <p>Donec dignissim, odio ac imperdiet luctus, ante nisl accumsan justo, nec tempus augue mi in nulla.</p>
                  </div>
                </div>

                <div class="timeline-item">
                  <div class="timeline-dot"></div>
                  <div class="timeline-content">
                    <h4>1998</h4>
                    <p>Suspendisse potenti. Nullam lacinia dictum auctor. Phasellus euismod sem at dui imperdiet, ac tincidunt mi placerat.</p>
                  </div>
                </div>

                <div class="timeline-item">
                  <div class="timeline-dot"></div>
                  <div class="timeline-content">
                    <h4>2010</h4>
                    <p>Vestibulum ultrices magna ut faucibus sollicitudin. Sed eget venenatis enim, nec imperdiet ex.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="about-image" data-aos="zoom-in" data-aos-delay="300">
              <img src="{{ asset('assets/img/education/campus-5.webp') }}" alt="Campus" class="img-fluid rounded">

              <div class="mission-vision" data-aos="fade-up" data-aos-delay="400">
                <div class="mission">
                  <h3>Our Mission</h3>
                  <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>
                </div>

                <div class="vision">
                  <h3>Our Vision</h3>
                  <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum porta.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-12">
            <div class="core-values" data-aos="fade-up" data-aos-delay="500">
              <h3 class="text-center mb-4">Core Values</h3>
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                  <div class="value-card">
                    <div class="value-icon">
                      <i class="bi bi-book"></i>
                    </div>
                    <h4>Academic Excellence</h4>
                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                  </div>
                </div>

                <div class="col">
                  <div class="value-card">
                    <div class="value-icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <h4>Community Engagement</h4>
                    <p>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
                  </div>
                </div>

                <div class="col">
                  <div class="value-card">
                    <div class="value-icon">
                      <i class="bi bi-lightbulb"></i>
                    </div>
                    <h4>Innovation</h4>
                    <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>
                  </div>
                </div>

                <div class="col">
                  <div class="value-card">
                    <div class="value-icon">
                      <i class="bi bi-globe"></i>
                    </div>
                    <h4>Global Perspective</h4>
                    <p>Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /History Section -->

    <!-- Leadership Section -->
    <section id="leadership" class="leadership section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row mb-5">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <h3 class="section-subtitle">Meet Our Leadership</h3>
            <h2 class="section-heading">Dedicated Administration Guiding Our Educational Excellence</h2>
            <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ipsum sit nibh amet egestas tellus. Eu leo morbi massa sem faucibus nulla gravida vulputate adipiscing. Sed malesuada quam scelerisque amet commodo arcu mollis.</p>
            <div class="stats-container mt-4">
              <div class="row">
                <div class="col-md-4 col-6">
                  <div class="stat-item">
                    <h3>25+</h3>
                    <p>Years of Excellence</p>
                  </div>
                </div>
                <div class="col-md-4 col-6">
                  <div class="stat-item">
                    <h3>45+</h3>
                    <p>Faculty Members</p>
                  </div>
                </div>
                <div class="col-md-4 col-6">
                  <div class="stat-item">
                    <h3>98%</h3>
                    <p>Student Success</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="about-image">
              <img src="{{ asset('assets/img/education/teacher-1.webp') }}" alt="Our Leadership Team" class="img-fluid rounded">
            </div>
          </div>
        </div>

        <div class="leadership-team">
          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-m-2.webp') }}" alt="Principal" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Dr. Michael Anderson</h4>
                  <p class="position">Principal</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-f-3.webp') }}" alt="Vice Principal" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Dr. Sarah Johnson</h4>
                  <p class="position">Vice Principal</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-m-5.webp') }}" alt="Dean of Students" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Prof. David Martinez</h4>
                  <p class="position">Dean of Students</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-f-8.webp') }}" alt="Academic Director" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Dr. Emily Chen</h4>
                  <p class="position">Academic Director</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-m-7.webp') }}" alt="Financial Director" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Robert Wilson</h4>
                  <p class="position">Financial Director</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-f-10.webp') }}" alt="Head of Admissions" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Jessica Parker</h4>
                  <p class="position">Head of Admissions</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-m-11.webp') }}" alt="IT Director" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Thomas Lee</h4>
                  <p class="position">IT Director</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
              <div class="leader-card">
                <div class="leader-image">
                  <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Student Welfare Officer" class="img-fluid">
                  <div class="social-links">
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                  </div>
                </div>
                <div class="leader-info">
                  <h4>Amanda Rodriguez</h4>
                  <p class="position">Student Welfare Officer</p>
                  <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus lectus a facilisis bibendum.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Leadership Section -->

@endsection
