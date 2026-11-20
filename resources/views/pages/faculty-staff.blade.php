@extends('layouts.site')

@section('title', 'Faculty Staff - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'faculty-staff-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Faculty Staff</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Faculty Staff</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Faculty  Staff Section -->
    <section id="faculty--staff" class="faculty--staff section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row mb-5">
          <div class="col-lg-8 mx-auto">
            <div class="search-container" data-aos="fade-up" data-aos-delay="200">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search faculty &amp; staff by name, department, or expertise...">
                <button class="btn search-btn" type="button"><i class="bi bi-search"></i></button>
              </div>
              <div class="filters mt-3">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="facultyFilter" checked="">
                  <label class="form-check-label" for="facultyFilter">Faculty</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="staffFilter" checked="">
                  <label class="form-check-label" for="staffFilter">Staff</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="researchFilter" checked="">
                  <label class="form-check-label" for="researchFilter">Research</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="adminFilter" checked="">
                  <label class="form-check-label" for="adminFilter">Administration</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="departments-nav">
              <h4 class="departments-title">Departments</h4>
              <ul class="nav nav-tabs flex-column">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#faculty--staff-tab-1">Computer Science</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faculty--staff-tab-2">Mathematics</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faculty--staff-tab-3">Physics</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faculty--staff-tab-4">Biology</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faculty--staff-tab-5">Chemistry</button>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-9" data-aos="fade-up" data-aos-delay="400">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="faculty--staff-tab-1">
                <div class="department-info mb-4">
                  <h3>Computer Science Department</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus, eros vel vestibulum laoreet, lacus mi efficitur velit, id pharetra odio magna nec augue.</p>
                </div>
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-3.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Jonathan Baker</h4>
                        <p class="faculty-title">Department Chair, Professor</p>
                        <div class="faculty-specialties">
                          <span>Artificial Intelligence</span>
                          <span>Machine Learning</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:jbaker@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-f-5.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Sarah Wilson</h4>
                        <p class="faculty-title">Associate Professor</p>
                        <div class="faculty-specialties">
                          <span>Data Science</span>
                          <span>Neural Networks</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:swilson@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-7.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Michael Chen</h4>
                        <p class="faculty-title">Assistant Professor</p>
                        <div class="faculty-specialties">
                          <span>Cybersecurity</span>
                          <span>Blockchain Technology</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:mchen@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-f-9.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Emily Rodriguez</h4>
                        <p class="faculty-title">Associate Professor</p>
                        <div class="faculty-specialties">
                          <span>Software Engineering</span>
                          <span>Human-Computer Interaction</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:erodriguez@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-11.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Robert Williams</h4>
                        <p class="faculty-title">Professor</p>
                        <div class="faculty-specialties">
                          <span>Algorithms</span>
                          <span>Computational Theory</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:rwilliams@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-f-2.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Angela Davis</h4>
                        <p class="faculty-title">Department Administrator</p>
                        <div class="faculty-specialties">
                          <span>Administration</span>
                          <span>Student Services</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:adavis@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="faculty--staff-tab-2">
                <div class="department-info mb-4">
                  <h3>Mathematics Department</h3>
                  <p>Curabitur a felis in nunc fringilla tristique. Fusce egestas elit eget lorem. Etiam vitae tortor. Nam at tortor in tellus interdum sagittis.</p>
                </div>
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-f-8.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Patricia Lee</h4>
                        <p class="faculty-title">Department Chair, Professor</p>
                        <div class="faculty-specialties">
                          <span>Algebraic Topology</span>
                          <span>Number Theory</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:plee@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-6.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Thomas Grant</h4>
                        <p class="faculty-title">Professor</p>
                        <div class="faculty-specialties">
                          <span>Analysis</span>
                          <span>Differential Equations</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:tgrant@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="faculty--staff-tab-3">
                <div class="department-info mb-4">
                  <h3>Physics Department</h3>
                  <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci.</p>
                </div>
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-9.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Neil Armstrong</h4>
                        <p class="faculty-title">Department Chair, Professor</p>
                        <div class="faculty-specialties">
                          <span>Quantum Physics</span>
                          <span>Astrophysics</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:narmstrong@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="faculty--staff-tab-4">
                <div class="department-info mb-4">
                  <h3>Biology Department</h3>
                  <p>Vivamus elementum semper nisi. Sed fringilla mauris sit amet nibh. In auctor lobortis lacus. Suspendisse non nisl sit amet velit hendrerit rutrum.</p>
                </div>
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-f-12.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Lisa Wong</h4>
                        <p class="faculty-title">Department Chair, Professor</p>
                        <div class="faculty-specialties">
                          <span>Molecular Biology</span>
                          <span>Genetics</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:lwong@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="faculty--staff-tab-5">
                <div class="department-info mb-4">
                  <h3>Chemistry Department</h3>
                  <p>Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce neque. Suspendisse faucibus.</p>
                </div>
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                      <div class="faculty-image">
                        <img src="{{ asset('assets/img/person/person-m-2.webp') }}" class="img-fluid" alt="Faculty Member">
                      </div>
                      <div class="faculty-info">
                        <h4>Dr. Daniel Smith</h4>
                        <p class="faculty-title">Department Chair, Professor</p>
                        <div class="faculty-specialties">
                          <span>Organic Chemistry</span>
                          <span>Biochemistry</span>
                        </div>
                        <div class="faculty-contact">
                          <a href="mailto:dsmith@example.com"><i class="bi bi-envelope"></i> Email</a>
                          <a href="#" class="profile-link"><i class="bi bi-person"></i> Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Faculty  Staff Section -->

@endsection
