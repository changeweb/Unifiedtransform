@extends('layouts.site')

@section('title', 'Privacy - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'privacy-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>Privacy</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Privacy</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Privacy Section -->
    <section id="privacy" class="privacy section">

      <div class="container" data-aos="fade-up">
        <!-- Header -->
        <div class="privacy-header" data-aos="fade-up">
          <div class="header-content">
            <div class="last-updated">Effective Date: February 27, 2025</div>
            <h1>Privacy Policy</h1>
            <p class="intro-text">This Privacy Policy describes how we collect, use, process, and disclose your information, including personal information, in conjunction with your access to and use of our services.</p>
          </div>
        </div>

        <!-- Main Content -->
        <div class="privacy-content" data-aos="fade-up">
          <!-- Introduction -->
          <div class="content-section">
            <h2>1. Introduction</h2>
            <p>When you use our services, you're trusting us with your information. We understand this is a big responsibility and work hard to protect your information and put you in control.</p>
            <p>This Privacy Policy is meant to help you understand what information we collect, why we collect it, and how you can update, manage, export, and delete your information.</p>
          </div>

          <!-- Information Collection -->
          <div class="content-section">
            <h2>2. Information We Collect</h2>
            <p>We collect information to provide better services to our users. The types of information we collect include:</p>

            <h3>2.1 Information You Provide</h3>
            <p>When you create an account or use our services, you provide us with personal information that includes:</p>
            <ul>
              <li>Your name and contact information</li>
              <li>Account credentials</li>
              <li>Payment information when required</li>
              <li>Communication preferences</li>
            </ul>

            <h3>2.2 Automatic Information</h3>
            <p>We automatically collect and store certain information when you use our services:</p>
            <ul>
              <li>Device information and identifiers</li>
              <li>Log information and usage statistics</li>
              <li>Location information when enabled</li>
              <li>Browser type and settings</li>
            </ul>
          </div>

          <!-- Use of Information -->
          <div class="content-section">
            <h2>3. How We Use Your Information</h2>
            <p>We use the information we collect to provide, maintain, and improve our services. Specifically, we use your information to:</p>
            <ul>
              <li>Provide and personalize our services</li>
              <li>Process transactions and send related information</li>
              <li>Send notifications and updates about our services</li>
              <li>Maintain security and verify identity</li>
              <li>Analyze and improve our services</li>
            </ul>
          </div>

          <!-- Information Sharing -->
          <div class="content-section">
            <h2>4. Information Sharing and Disclosure</h2>
            <p>We do not share personal information with companies, organizations, or individuals outside of our company except in the following cases:</p>

            <h3>4.1 With Your Consent</h3>
            <p>We will share personal information with companies, organizations, or individuals outside of our company when we have your consent to do so.</p>

            <h3>4.2 For Legal Reasons</h3>
            <p>We will share personal information if we have a good-faith belief that access, use, preservation, or disclosure of the information is reasonably necessary to:</p>
            <ul>
              <li>Meet any applicable law, regulation, legal process, or enforceable governmental request</li>
              <li>Enforce applicable Terms of Service</li>
              <li>Detect, prevent, or otherwise address fraud, security, or technical issues</li>
              <li>Protect against harm to the rights, property, or safety of our users</li>
            </ul>
          </div>

          <!-- Data Security -->
          <div class="content-section">
            <h2>5. Data Security</h2>
            <p>We work hard to protect our users from unauthorized access to or unauthorized alteration, disclosure, or destruction of information we hold. In particular:</p>
            <ul>
              <li>We encrypt our services using SSL</li>
              <li>We review our information collection, storage, and processing practices</li>
              <li>We restrict access to personal information to employees who need that information</li>
            </ul>
          </div>

          <!-- Your Rights -->
          <div class="content-section">
            <h2>6. Your Rights and Choices</h2>
            <p>You have certain rights regarding your personal information, including:</p>
            <ul>
              <li>The right to access your personal information</li>
              <li>The right to correct inaccurate information</li>
              <li>The right to request deletion of your information</li>
              <li>The right to restrict or object to our processing of your information</li>
            </ul>
          </div>

          <!-- Policy Updates -->
          <div class="content-section">
            <h2>7. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the effective date at the top.</p>
            <p>Your continued use of our services after any changes to this Privacy Policy constitutes your acceptance of such changes.</p>
          </div>
        </div>

        <!-- Contact Section -->
        <div class="privacy-contact" data-aos="fade-up">
          <h2>Contact Us</h2>
          <p>If you have any questions about this Privacy Policy or our practices, please contact us:</p>
          <div class="contact-details">
            <p><strong>Email:</strong> privacy@example.com</p>
            <p><strong>Address:</strong> 123 Privacy Street, Security City, 12345</p>
          </div>
        </div>

      </div>

    </section><!-- /Privacy Section -->

@endsection
