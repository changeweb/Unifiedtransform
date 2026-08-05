@extends('layouts.site')

@section('title', 'Terms Of Service - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'terms-of-service-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Terms Of Service</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Terms Of Service</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Terms Of Service Section -->
    <section id="terms-of-service" class="terms-of-service section">

      <div class="container" data-aos="fade-up">
        <!-- Hero Section -->
        <div class="terms-hero" data-aos="fade-up">
          <span class="badge">Last Updated: February 27, 2025</span>
          <h2>Terms &amp; Conditions</h2>
          <p>These terms and conditions outline your rights and responsibilities when using our services</p>
          <div class="terms-highlights">
            <div class="highlight-item">
              <i class="bi bi-shield-check"></i>
              <span>Secure Service</span>
            </div>
            <div class="highlight-item">
              <i class="bi bi-lock"></i>
              <span>Data Protection</span>
            </div>
            <div class="highlight-item">
              <i class="bi bi-hand-thumbs-up"></i>
              <span>Fair Terms</span>
            </div>
          </div>
        </div>

        <!-- Terms Grid -->
        <div class="terms-grid" data-aos="fade-up">
          <!-- Agreement Card -->
          <div class="terms-card" data-aos="fade-up" data-aos-delay="100">
            <div class="card-header">
              <div class="header-icon">
                <i class="bi bi-file-text"></i>
              </div>
              <h3>Agreement Terms</h3>
            </div>
            <div class="card-content">
              <p>By accessing our service, you confirm that you are agreeing to be bound by these terms of service. These terms apply to all users and visitors.</p>
              <ul class="check-list">
                <li>Acceptance of terms</li>
                <li>Compliance with laws</li>
                <li>Service availability</li>
                <li>User obligations</li>
              </ul>
            </div>
          </div>

          <!-- User Rights Card -->
          <div class="terms-card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-header">
              <div class="header-icon">
                <i class="bi bi-person-check"></i>
              </div>
              <h3>User Rights</h3>
            </div>
            <div class="card-content">
              <p>As a user, you have specific rights when using our service, including data privacy and access to features.</p>
              <ul class="check-list">
                <li>Account control</li>
                <li>Data privacy</li>
                <li>Service access</li>
                <li>Content ownership</li>
              </ul>
            </div>
          </div>

          <!-- Restrictions Card -->
          <div class="terms-card" data-aos="fade-up" data-aos-delay="300">
            <div class="card-header">
              <div class="header-icon">
                <i class="bi bi-shield-x"></i>
              </div>
              <h3>Restrictions</h3>
            </div>
            <div class="card-content">
              <div class="restrictions-list">
                <div class="restriction-item">
                  <i class="bi bi-x-circle"></i>
                  <span>No unauthorized data collection</span>
                </div>
                <div class="restriction-item">
                  <i class="bi bi-x-circle"></i>
                  <span>No service misuse</span>
                </div>
                <div class="restriction-item">
                  <i class="bi bi-x-circle"></i>
                  <span>No intellectual property violation</span>
                </div>
                <div class="restriction-item">
                  <i class="bi bi-x-circle"></i>
                  <span>No harmful activities</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Key Points -->
        <div class="terms-points" data-aos="fade-up">
          <h3>Key Points to Note</h3>
          <div class="points-grid">
            <div class="point-item">
              <div class="point-icon">
                <i class="bi bi-clock-history"></i>
              </div>
              <div class="point-content">
                <h4>Service Availability</h4>
                <p>We strive to provide uninterrupted service but cannot guarantee 100% availability.</p>
              </div>
            </div>

            <div class="point-item">
              <div class="point-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <div class="point-content">
                <h4>Privacy Protection</h4>
                <p>Your data is protected according to our privacy policy and applicable laws.</p>
              </div>
            </div>

            <div class="point-item">
              <div class="point-icon">
                <i class="bi bi-pencil-square"></i>
              </div>
              <div class="point-content">
                <h4>Content Rights</h4>
                <p>You retain rights to your content while granting us license to use it.</p>
              </div>
            </div>
          </div>

          <!-- Important Notices -->
          <div class="terms-notices" data-aos="fade-up">
            <div class="notice-wrapper">
              <div class="notice-items">
                <div class="notice-item">
                  <div class="notice-marker">
                    <i class="bi bi-exclamation-circle"></i>
                  </div>
                  <div class="notice-content">
                    <h4>Service Modifications</h4>
                    <p>We reserve the right to modify or discontinue any part of our service with or without notice.</p>
                  </div>
                </div>

                <div class="notice-item">
                  <div class="notice-marker">
                    <i class="bi bi-exclamation-circle"></i>
                  </div>
                  <div class="notice-content">
                    <h4>Account Termination</h4>
                    <p>We may terminate accounts that violate these terms or for any other reason at our discretion.</p>
                  </div>
                </div>

                <div class="notice-item">
                  <div class="notice-marker">
                    <i class="bi bi-exclamation-circle"></i>
                  </div>
                  <div class="notice-content">
                    <h4>Terms Updates</h4>
                    <p>These terms may be updated at any time. Continued use of the service implies acceptance.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Box -->
          <div class="terms-contact" data-aos="fade-up">
            <div class="contact-wrapper">
              <div class="contact-content">
                <div class="contact-text">
                  <h4>Need Clarification?</h4>
                  <p>If you have questions about these terms, our support team is here to help.</p>
                </div>
                <div class="contact-actions">
                  <a href="#" class="btn-primary">Contact Support</a>
                  <a href="#" class="btn-outline">Download Terms</a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- /Terms Of Service Section -->

@endsection
