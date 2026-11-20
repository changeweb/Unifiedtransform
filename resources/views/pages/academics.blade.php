@extends('layouts.site')

@section('title', 'Academics - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'academics-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Academics</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Academics</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Academics Section -->
    <section id="academics" class="academics section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="intro-wrapper">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
              <div class="intro-image">
                <img src="{{ asset('assets/img/education/education-1.webp') }}" alt="Academic Programs" class="img-fluid rounded-lg shadow">
                <div class="accent-shape"></div>
              </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
              <div class="intro-content">
                <span class="subtitle">Excellence in Education</span>
                <h2>Discover Our Academic Programs</h2>
                <p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed non mauris vitae erat consequat auctor eu in elit.</p>
                <div class="key-highlights">
                  <div class="highlight-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Experiential learning opportunities</span>
                  </div>
                  <div class="highlight-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>World-class faculty members</span>
                  </div>
                  <div class="highlight-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Cutting-edge research facilities</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="programs-navigation" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
            <div class="col-12">
              <div class="program-tabs">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#academics-all" type="button" role="tab">
                      <span class="icon"><i class="bi bi-grid-3x3-gap"></i></span>
                      <span class="text">All Programs</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="undergraduate-tab" data-bs-toggle="tab" data-bs-target="#academics-undergraduate" type="button" role="tab">
                      <span class="icon"><i class="bi bi-mortarboard"></i></span>
                      <span class="text">Undergraduate</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="graduate-tab" data-bs-toggle="tab" data-bs-target="#academics-graduate" type="button" role="tab">
                      <span class="icon"><i class="bi bi-book"></i></span>
                      <span class="text">Graduate</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doctoral-tab" data-bs-toggle="tab" data-bs-target="#academics-doctoral" type="button" role="tab">
                      <span class="icon"><i class="bi bi-award"></i></span>
                      <span class="text">Doctoral</span>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-content programs-content" data-aos="fade-up" data-aos-delay="200">
          <!-- All Programs Tab -->
          <div class="tab-pane fade show active" id="academics-all" role="tabpanel">
            <div class="row g-4">
              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-item undergraduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-cpu"></i>
                    </div>
                    <span class="program-type">Undergraduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Computer Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> B.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="program-item graduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <span class="program-type">Graduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Business Administration</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 2 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> MBA Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="program-item doctoral">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-diagram-3"></i>
                    </div>
                    <span class="program-type">Doctoral</span>
                  </div>
                  <div class="program-body">
                    <h3>Neuroscience</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 5 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> Ph.D. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall Intake</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-item undergraduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-tree"></i>
                    </div>
                    <span class="program-type">Undergraduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Environmental Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> B.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="program-item graduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-graph-up"></i>
                    </div>
                    <span class="program-type">Graduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Data Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 2 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> M.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="program-item doctoral">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <span class="program-type">Doctoral</span>
                  </div>
                  <div class="program-body">
                    <h3>Psychology</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> Ph.D. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall Intake</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Undergraduate Tab -->
          <div class="tab-pane fade" id="academics-undergraduate" role="tabpanel">
            <div class="row g-4">
              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                <div class="program-item undergraduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-cpu"></i>
                    </div>
                    <span class="program-type">Undergraduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Computer Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> B.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-item undergraduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-tree"></i>
                    </div>
                    <span class="program-type">Undergraduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Environmental Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> B.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Graduate Tab -->
          <div class="tab-pane fade" id="academics-graduate" role="tabpanel">
            <div class="row g-4">
              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                <div class="program-item graduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <span class="program-type">Graduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Business Administration</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 2 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> MBA Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-item graduate">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-graph-up"></i>
                    </div>
                    <span class="program-type">Graduate</span>
                  </div>
                  <div class="program-body">
                    <h3>Data Science</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 2 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> M.Sc. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall &amp; Spring</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Doctoral Tab -->
          <div class="tab-pane fade" id="academics-doctoral" role="tabpanel">
            <div class="row g-4">
              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                <div class="program-item doctoral">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-diagram-3"></i>
                    </div>
                    <span class="program-type">Doctoral</span>
                  </div>
                  <div class="program-body">
                    <h3>Neuroscience</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 5 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> Ph.D. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall Intake</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <!-- Program Item -->
              <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="program-item doctoral">
                  <div class="program-header">
                    <div class="program-icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <span class="program-type">Doctoral</span>
                  </div>
                  <div class="program-body">
                    <h3>Psychology</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                    <ul class="program-details">
                      <li><i class="bi bi-clock"></i> 4 years</li>
                      <li><i class="bi bi-mortarboard-fill"></i> Ph.D. Degree</li>
                      <li><i class="bi bi-calendar-check"></i> Fall Intake</li>
                    </ul>
                  </div>
                  <div class="program-footer">
                    <a href="#" class="program-link">View Program <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="featured-program-wrapper" data-aos="fade-up">
          <div class="row">
            <div class="col-12">
              <div class="section-heading text-center mb-4">
                <h2>Featured Program</h2>
                <p>Our most sought-after academic offering</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="featured-program-card">
                <div class="row align-items-center">
                  <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                    <div class="featured-program-image">
                      <img src="{{ asset('assets/img/education/education-5.webp') }}" alt="Artificial Intelligence Program" class="img-fluid">
                      <div class="program-label">
                        <span>Featured</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                    <div class="featured-program-content">
                      <h3>Master of Science in Artificial Intelligence</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum.</p>

                      <div class="program-highlights">
                        <div class="highlight">
                          <div class="highlight-icon">
                            <i class="bi bi-clock"></i>
                          </div>
                          <div class="highlight-info">
                            <h4>Duration</h4>
                            <p>24 Months</p>
                          </div>
                        </div>
                        <div class="highlight">
                          <div class="highlight-icon">
                            <i class="bi bi-cash-stack"></i>
                          </div>
                          <div class="highlight-info">
                            <h4>Avg. Starting Salary</h4>
                            <p>$82,000</p>
                          </div>
                        </div>
                        <div class="highlight">
                          <div class="highlight-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                          </div>
                          <div class="highlight-info">
                            <h4>Employment Rate</h4>
                            <p>94%</p>
                          </div>
                        </div>
                      </div>

                      <div class="featured-program-action">
                        <a href="#" class="btn-apply">Apply Now</a>
                        <a href="#" class="btn-details">Program Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="stats-wrapper" data-aos="fade-up">
          <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
              <div class="stats-content">
                <span class="subtitle">By The Numbers</span>
                <h2>Our Academic Excellence</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas sed diam eget risus varius blandit.</p>
                <a href="#" class="btn-about">About Our Institution</a>
              </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
              <div class="stats-grid">
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                  <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="92" data-purecounter-duration="1" class="purecounter"></span>%
                  </div>
                  <div class="stat-title">Student Satisfaction</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                  <div class="stat-icon">
                    <i class="bi bi-journal-bookmark-fill"></i>
                  </div>
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>+
                  </div>
                  <div class="stat-title">Academic Programs</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                  <div class="stat-icon">
                    <i class="bi bi-award-fill"></i>
                  </div>
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter"></span>+
                  </div>
                  <div class="stat-title">Research Centers</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                  <div class="stat-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                  </div>
                  <div class="stat-number">
                    <span data-purecounter-start="0" data-purecounter-end="96" data-purecounter-duration="1" class="purecounter"></span>%
                  </div>
                  <div class="stat-title">Graduation Rate</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Academics Section -->

@endsection
