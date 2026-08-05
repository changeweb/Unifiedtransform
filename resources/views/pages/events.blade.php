@extends('layouts.site')

@section('title', 'Events - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'events-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Events</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Events</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Events 2 Section -->
    <section id="events-2" class="events-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="events-list">
              <div class="event-item" data-aos="fade-up">
                <div class="event-date">
                  <span class="day">15</span>
                  <span class="month">JUN</span>
                </div>
                <div class="event-content">
                  <h3>Annual Science Fair Exhibition</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> 09:00 AM - 04:00 PM</p>
                    <p><i class="bi bi-geo-alt"></i> Main Campus Auditorium</p>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Proin gravida dolor sit amet lacus accumsan.</p>
                  <a href="#" class="btn-event">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="100">
                <div class="event-date">
                  <span class="day">22</span>
                  <span class="month">JUN</span>
                </div>
                <div class="event-content">
                  <h3>Parent-Teacher Conference</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> 01:00 PM - 06:00 PM</p>
                    <p><i class="bi bi-geo-alt"></i> Multiple Classrooms</p>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Proin sagittis nisl rhoncus mattis rhoncus.</p>
                  <a href="#" class="btn-event">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="200">
                <div class="event-date">
                  <span class="day">30</span>
                  <span class="month">JUN</span>
                </div>
                <div class="event-content">
                  <h3>Summer Sports Tournament Final</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> 02:30 PM - 05:30 PM</p>
                    <p><i class="bi bi-geo-alt"></i> Sports Complex</p>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                  <a href="#" class="btn-event">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="300">
                <div class="event-date">
                  <span class="day">05</span>
                  <span class="month">JUL</span>
                </div>
                <div class="event-content">
                  <h3>Graduation Ceremony Class of 2023</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> 10:00 AM - 01:00 PM</p>
                    <p><i class="bi bi-geo-alt"></i> Central Auditorium</p>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ante ipsum primis.</p>
                  <a href="#" class="btn-event">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->
            </div>

            <div class="pagination-wrapper" data-aos="fade-up" data-aos-delay="400">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="bi bi-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item" data-aos="fade-up" data-aos-delay="100">
                <h3 class="sidebar-title">Upcoming Events</h3>
                <div class="event-calendar">
                  <div class="calendar-header">
                    <h4>June 2023</h4>
                  </div>
                  <div class="calendar-body">
                    <div class="weekdays">
                      <div>Su</div>
                      <div>Mo</div>
                      <div>Tu</div>
                      <div>We</div>
                      <div>Th</div>
                      <div>Fr</div>
                      <div>Sa</div>
                    </div>
                    <div class="days">
                      <div class="day other-month">28</div>
                      <div class="day other-month">29</div>
                      <div class="day other-month">30</div>
                      <div class="day other-month">31</div>
                      <div class="day">1</div>
                      <div class="day">2</div>
                      <div class="day">3</div>
                      <div class="day">4</div>
                      <div class="day">5</div>
                      <div class="day">6</div>
                      <div class="day">7</div>
                      <div class="day">8</div>
                      <div class="day">9</div>
                      <div class="day">10</div>
                      <div class="day">11</div>
                      <div class="day">12</div>
                      <div class="day">13</div>
                      <div class="day">14</div>
                      <div class="day has-event">15</div>
                      <div class="day">16</div>
                      <div class="day">17</div>
                      <div class="day">18</div>
                      <div class="day">19</div>
                      <div class="day">20</div>
                      <div class="day">21</div>
                      <div class="day has-event">22</div>
                      <div class="day">23</div>
                      <div class="day">24</div>
                      <div class="day">25</div>
                      <div class="day">26</div>
                      <div class="day">27</div>
                      <div class="day">28</div>
                      <div class="day">29</div>
                      <div class="day has-event">30</div>
                      <div class="day other-month">1</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="sidebar-item featured-event" data-aos="fade-up" data-aos-delay="200">
                <h3 class="sidebar-title">Featured Event</h3>
                <div class="featured-event-content">
                  <img src="{{ asset('assets/img/education/events-5.webp') }}" alt="Featured Event" class="img-fluid">
                  <h4>Annual Arts Festival</h4>
                  <p><i class="bi bi-calendar-event"></i> July 15-17, 2023</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus consectetur adipiscing elit.</p>
                  <a href="#" class="btn-register">Register Now</a>
                </div>
              </div>

              <div class="sidebar-item" data-aos="fade-up" data-aos-delay="300">
                <h3 class="sidebar-title">Event Categories</h3>
                <div class="categories">
                  <ul>
                    <li><a href="#">Academic <span>(12)</span></a></li>
                    <li><a href="#">Sports <span>(8)</span></a></li>
                    <li><a href="#">Cultural <span>(6)</span></a></li>
                    <li><a href="#">Workshops <span>(4)</span></a></li>
                    <li><a href="#">Conferences <span>(3)</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Events 2 Section -->

@endsection
