@extends('layouts.app')

@section('content')
<!-- About Section -->
<section id="about" class="about section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-image">
              <img src="{{ asset($profile['image']) }}" alt="Profile Image" class="img-fluid">
            </div>
            <div class="profile-badge">
              <i class="bi bi-check-circle-fill"></i>
            </div>
          </div>

          <div class="profile-content">
            <h3>{{ $profile['name'] }}</h3>
            <p class="profession">{{ $profile['profession'] }}</p>

            <div class="contact-links">
              <a href="mailto:{{ $profile['email'] }}" class="contact-item">
                <i class="bi bi-envelope"></i>
                {{ $profile['email'] }}
              </a>
              <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', $profile['phone']) }}" class="contact-item">
                <i class="bi bi-telephone"></i>
                {{ $profile['phone'] }}
              </a>
              <a href="#" class="contact-item">
                <i class="bi bi-geo-alt"></i>
                {{ $profile['location'] }}
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
        <div class="about-content">
          <div class="section-header">
            <span class="badge-text">Get to Know Me</span>
            <h2>Passionate About Creating Digital Experiences</h2>
          </div>

          <div class="description">
            <p>{{ $profile['description'] }}</p>
            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
          </div>

          <div class="stats-grid">
            @foreach($stats as $stat)
            <div class="stat-item">
              <div class="stat-number">{{ $stat['number'] }}</div>
              <div class="stat-label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
          </div>

          <div class="details-grid">
            <div class="detail-row">
              @foreach($details as $index => $detail)
                @if($index % 2 == 0 && $index > 0)
                  </div><div class="detail-row">
                @endif
                <div class="detail-item">
                  <span class="detail-label">{{ $detail['label'] }}</span>
                  <span class="detail-value">{{ $detail['value'] }}</span>
                </div>
              @endforeach
            </div>
          </div>

          <div class="cta-section">
            <a href="{{ route('resume') }}" class="btn btn-primary">
              <i class="bi bi-download"></i>
              Download Resume
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline">
              <i class="bi bi-chat-dots"></i>
              Let's Talk
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /About Section -->

<!-- Skills Section -->
<section id="skills" class="skills section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
    <p>My technical expertise and professional capabilities</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-12">
        <div class="skills-category" data-aos="fade-up" data-aos-delay="200">
          <h3>Technical Skills</h3>
          <div class="skills-animation">
            @foreach($skills as $skill)
            <div class="skill-item">
              <div class="d-flex justify-content-between align-items-center">
                <h4>{{ $skill['name'] }}</h4>
                <span class="skill-percentage">{{ $skill['percentage'] }}%</span>
              </div>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $skill['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Skills Section -->
@endsection