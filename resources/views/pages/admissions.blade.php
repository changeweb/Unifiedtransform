@extends('layouts.site')

@section('title', 'Admissions - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'admissions-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Admissions</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Admissions</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Admissions Section -->
    <section id="admissions" class="admissions section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 g-lg-5">
          <div class="col-lg-6">
            <div class="admissions-info" data-aos="fade-up">
              <h2>Begin Your Academic Journey Today</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet.</p>

              <div class="admissions-steps mt-5">
                <h3>How to Apply</h3>
                <div class="steps-wrapper mt-4">
                  <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-number">1</div>
                    <div class="step-content">
                      <h4>Submit Application</h4>
                      <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Sed porttitor lectus nibh. Praesent sapien massa.</p>
                    </div>
                  </div>

                  <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-number">2</div>
                    <div class="step-content">
                      <h4>Send Documents</h4>
                      <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel.</p>
                    </div>
                  </div>

                  <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-number">3</div>
                    <div class="step-content">
                      <h4>Interview Process</h4>
                      <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla porttitor accumsan tincidunt.</p>
                    </div>
                  </div>

                  <div class="step-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-number">4</div>
                    <div class="step-content">
                      <h4>Receive Decision</h4>
                      <p>Vivamus suscipit tortor eget felis porttitor volutpat. Cras ultricies ligula sed magna dictum porta. Nulla quis lorem ut libero.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="deadlines mt-5" data-aos="fade-up">
                <h3>Key Admission Deadlines</h3>
                <div class="deadline-grid mt-4">
                  <div class="deadline-item">
                    <h4>Fall Semester</h4>
                    <div class="date">March 15, 2023</div>
                  </div>
                  <div class="deadline-item">
                    <h4>Spring Semester</h4>
                    <div class="date">October 1, 2023</div>
                  </div>
                  <div class="deadline-item">
                    <h4>Summer Session</h4>
                    <div class="date">January 30, 2024</div>
                  </div>
                  <div class="deadline-item">
                    <h4>Early Decision</h4>
                    <div class="date">November 15, 2023</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="admissions-requirements" data-aos="fade-up">
              <h3>Admission Requirements</h3>
              <div class="requirements-list mt-4">
                <div class="requirement-item" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon-box">
                    <i class="bi bi-mortarboard-fill"></i>
                  </div>
                  <div>
                    <h4>Academic Records</h4>
                    <p>Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed.</p>
                  </div>
                </div>

                <div class="requirement-item" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon-box">
                    <i class="bi bi-file-earmark-text"></i>
                  </div>
                  <div>
                    <h4>Recommendation Letters</h4>
                    <p>Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus.</p>
                  </div>
                </div>

                <div class="requirement-item" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box">
                    <i class="bi bi-journal-richtext"></i>
                  </div>
                  <div>
                    <h4>Personal Statement</h4>
                    <p>Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat.</p>
                  </div>
                </div>

                <div class="requirement-item" data-aos="fade-up" data-aos-delay="400">
                  <div class="icon-box">
                    <i class="bi bi-graph-up"></i>
                  </div>
                  <div>
                    <h4>Standardized Tests</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet elit.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="request-info mt-5" data-aos="fade-up">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Request Information</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida nibh vel velit auctor aliquet.</p>

                  <form class="php-email-form mt-4" action="forms/contact.php">
                    <div class="mb-3">
                      <input type="text" name="name" class="form-control" placeholder="Full Name" required="">
                    </div>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Email Address" required="">
                    </div>
                    <div class="mb-3">
                      <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="mb-3">
                      <select name="subject" class="form-select" required="">
                        <option value="" selected="" disabled="">Program of Interest</option>
                        <option value="Undergraduate">Undergraduate</option>
                        <option value="Graduate">Graduate</option>
                        <option value="Doctoral">Doctoral</option>
                        <option value="Certificate">Certificate</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <textarea name="message" class="form-control" rows="3" placeholder="Questions or Comments" required=""></textarea>
                    </div>
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your request has been sent. Thank you!</div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="cta-wrapper mt-5" data-aos="fade-up">
          <div class="row g-0">
            <div class="col-md-6">
              <div class="cta-item tour">
                <i class="bi bi-building"></i>
                <h3>Visit Our Campus</h3>
                <p>Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat.</p>
                <a href="#" class="btn btn-secondary">Schedule a Tour</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="cta-item apply">
                <i class="bi bi-file-earmark-check"></i>
                <h3>Ready to Apply?</h3>
                <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur non nulla sit amet.</p>
                <a href="#" class="btn btn-primary">Start Application</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Admissions Section -->

@endsection
