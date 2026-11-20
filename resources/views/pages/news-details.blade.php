@extends('layouts.site')

@section('title', 'News Details - ' . config('app.name', 'KWONG CHOW SCHOOL'))
@section('body-class', 'news-details-page')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>News Details</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">News Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Details Section -->
    <section id="blog-details" class="blog-details section">
      <div class="container" data-aos="fade-up">

        <article class="article">
          <div class="article-header">
            <div class="meta-categories" data-aos="fade-up">
              <a href="#" class="category">Technology</a>
              <a href="#" class="category">Innovation</a>
            </div>

            <h1 class="title" data-aos="fade-up" data-aos-delay="100">The Evolution of User Interface Design: From Skeuomorphism to Neumorphism</h1>

            <div class="article-meta" data-aos="fade-up" data-aos-delay="200">
              <div class="author">
                <img src="{{ asset('assets/img/person/person-m-6.webp') }}" alt="Author" class="author-img">
                <div class="author-info">
                  <h4>David Wilson</h4>
                  <span>UI/UX Design Lead</span>
                </div>
              </div>
              <div class="post-info">
                <span><i class="bi bi-calendar4-week"></i> April 15, 2025</span>
                <span><i class="bi bi-clock"></i> 10 min read</span>
                <span><i class="bi bi-chat-square-text"></i> 32 Comments</span>
              </div>
            </div>
          </div>

          <div class="article-featured-image" data-aos="zoom-in">
            <img src="{{ asset('assets/img/blog/blog-hero-1.webp') }}" alt="UI Design Evolution" class="img-fluid">
          </div>

          <div class="article-wrapper">
            <aside class="table-of-contents" data-aos="fade-left">
              <h3>Table of Contents</h3>
              <nav>
                <ul>
                  <li><a href="#introduction" class="active">Introduction</a></li>
                  <li><a href="#skeuomorphism">The Skeuomorphic Era</a></li>
                  <li><a href="#flat-design">Flat Design Revolution</a></li>
                  <li><a href="#material-design">Material Design</a></li>
                  <li><a href="#neumorphism">Rise of Neumorphism</a></li>
                  <li><a href="#future">Future Trends</a></li>
                </ul>
              </nav>
            </aside>

            <div class="article-content">
              <div class="content-section" id="introduction" data-aos="fade-up">
                <p class="lead">
                  The journey of user interface design has been marked by significant shifts in aesthetic approaches, each era bringing its own unique perspective on how digital interfaces should look and feel.
                </p>

                <p>
                  From the early days of graphical user interfaces to today's sophisticated design systems, the evolution of UI design reflects not just technological advancement, but also changing user expectations and cultural shifts in how we interact with digital products.
                </p>

                <div class="highlight-quote">
                  <blockquote>
                    <p>Design is not just what it looks like and feels like. Design is how it works.</p>
                    <cite>Steve Jobs</cite>
                  </blockquote>
                </div>
              </div>

              <div class="content-section" id="skeuomorphism" data-aos="fade-up">
                <h2>The Skeuomorphic Era</h2>
                <div class="image-with-caption right">
                  <img src="{{ asset('assets/img/blog/blog-hero-2.webp') }}" alt="Skeuomorphic Design Example" class="img-fluid" loading="lazy">
                  <figcaption>Early iOS design showcasing skeuomorphic elements</figcaption>
                </div>
                <p>
                  Skeuomorphic design dominated the early years of digital interfaces, attempting to mirror real-world objects in digital form. This approach helped users transition from physical to digital interactions through familiar visual metaphors.
                </p>

                <div class="feature-points">
                  <div class="point">
                    <i class="bi bi-layers"></i>
                    <div>
                      <h4>Realistic Textures</h4>
                      <p>Detailed representations of materials like leather, metal, and paper</p>
                    </div>
                  </div>
                  <div class="point">
                    <i class="bi bi-lightbulb"></i>
                    <div>
                      <h4>Familiar Metaphors</h4>
                      <p>Digital elements mimicking their physical counterparts</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-section" id="flat-design" data-aos="fade-up">
                <h2>The Flat Design Revolution</h2>
                <p>
                  As users became more comfortable with digital interfaces, design began moving towards simplification. Flat design emerged as a reaction to the ornate details of skeuomorphism, emphasizing clarity and efficiency.
                </p>

                <div class="comparison-grid">
                  <div class="row g-4">
                    <div class="col-md-6">
                      <div class="comparison-card">
                        <div class="icon"><i class="bi bi-check-circle"></i></div>
                        <h4>Advantages</h4>
                        <ul>
                          <li>Improved loading times</li>
                          <li>Better scalability</li>
                          <li>Cleaner visual hierarchy</li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="comparison-card">
                        <div class="icon"><i class="bi bi-exclamation-circle"></i></div>
                        <h4>Challenges</h4>
                        <ul>
                          <li>Reduced visual cues</li>
                          <li>Potential usability issues</li>
                          <li>Limited depth perception</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-section" id="material-design" data-aos="fade-up">
                <h2>Material Design: Finding Balance</h2>
                <p>
                  Google's Material Design emerged as a comprehensive design system that combined the simplicity of flat design with subtle depth cues, creating a more intuitive user experience while maintaining modern aesthetics.
                </p>

                <div class="key-principles">
                  <div class="principle">
                    <span class="number">01</span>
                    <h4>Physical Properties</h4>
                    <p>Surfaces and edges provide meaningful interaction cues</p>
                  </div>
                  <div class="principle">
                    <span class="number">02</span>
                    <h4>Bold Graphics</h4>
                    <p>Deliberate color choices and intentional white space</p>
                  </div>
                  <div class="principle">
                    <span class="number">03</span>
                    <h4>Meaningful Motion</h4>
                    <p>Animation informs and reinforces user actions</p>
                  </div>
                </div>
              </div>

              <div class="content-section" id="neumorphism" data-aos="fade-up">
                <h2>The Rise of Neumorphism</h2>
                <p>
                  Neumorphism represents the latest evolution in UI design, combining aspects of skeuomorphism with modern minimal aesthetics. This style creates soft, extruded surfaces that appear to emerge from the background.
                </p>

                <div class="info-box">
                  <div class="icon">
                    <i class="bi bi-info-circle"></i>
                  </div>
                  <div class="content">
                    <h4>Key Characteristics</h4>
                    <p>Neumorphic design relies on subtle shadow work to create the illusion of elements either protruding from or being pressed into their background surface.</p>
                  </div>
                </div>
              </div>

              <div class="content-section" id="future" data-aos="fade-up">
                <h2>Looking to the Future</h2>
                <p>
                  As we look ahead, UI design continues to evolve with new technologies and user expectations. The future may bring more personalized, adaptive interfaces that respond to individual user preferences and contexts.
                </p>

                <div class="future-trends">
                  <div class="trend">
                    <i class="bi bi-phone"></i>
                    <h4>Adaptive Interfaces</h4>
                    <p>Interfaces that automatically adjust based on user behavior and preferences</p>
                  </div>
                  <div class="trend">
                    <i class="bi bi-eye"></i>
                    <h4>Immersive Experiences</h4>
                    <p>Integration of AR and VR elements in everyday interfaces</p>
                  </div>
                  <div class="trend">
                    <i class="bi bi-hand-index"></i>
                    <h4>Gesture Controls</h4>
                    <p>Advanced motion and gesture-based interactions</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="article-footer" data-aos="fade-up">
            <div class="share-article">
              <h4>Share this article</h4>
              <div class="share-buttons">
                <a href="#" class="share-button twitter">
                  <i class="bi bi-twitter-x"></i>
                  <span>Share on X</span>
                </a>
                <a href="#" class="share-button facebook">
                  <i class="bi bi-facebook"></i>
                  <span>Share on Facebook</span>
                </a>
                <a href="#" class="share-button linkedin">
                  <i class="bi bi-linkedin"></i>
                  <span>Share on LinkedIn</span>
                </a>
              </div>
            </div>

            <div class="article-tags">
              <h4>Related Topics</h4>
              <div class="tags">
                <a href="#" class="tag">UI Design</a>
                <a href="#" class="tag">User Experience</a>
                <a href="#" class="tag">Design Trends</a>
                <a href="#" class="tag">Innovation</a>
                <a href="#" class="tag">Technology</a>
              </div>
            </div>
          </div>

        </article>

      </div>
    </section><!-- /Blog Details Section -->

@endsection
