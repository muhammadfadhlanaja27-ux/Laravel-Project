@extends('layouts.app')

@section('content')
<!-- Resume Section -->
<section id="resume" class="resume section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Resume</h2>
    <p>My professional journey and achievements</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <!-- Left column with summary and contact -->
      <div class="col-lg-4">
        <div class="resume-side" data-aos="fade-right" data-aos-delay="100">
          <div class="profile-img mb-4">
            <img src="{{ asset($profile_image) }}" alt="Profile" class="img-fluid rounded">
          </div>

          <h3>Professional Summary</h3>
          <p>{{ $summary }}</p>

          <h3 class="mt-4">Contact Information</h3>
          <ul class="contact-info list-unstyled">
            @foreach($contact_info as $info)
            <li><i class="bi {{ $info['icon'] }}"></i> {{ $info['text'] }}</li>
            @endforeach
          </ul>

          <div class="skills-animation mt-4">
            <h3>Technical Skills</h3>
            @foreach($technical_skills as $skill)
            <div class="skill-item">
              <div class="d-flex justify-content-between">
                <span>{{ $skill['name'] }}</span>
                <span>{{ $skill['percentage'] }}%</span>
              </div>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $skill['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Right column with experience and education -->
      <div class="col-lg-8 ps-4 ps-lg-5">
        <!-- Experience Section -->
        <div class="resume-section" data-aos="fade-up">
          <h3><i class="bi bi-briefcase me-2"></i>Professional Experience</h3>

          @foreach($experience as $exp)
          <div class="resume-item">
            <h4>{{ $exp['title'] }}</h4>
            <h5>{{ $exp['period'] }}</h5>
            <p class="company"><i class="bi bi-building"></i> {{ $exp['company'] }}</p>
            <ul>
              @foreach($exp['responsibilities'] as $responsibility)
              <li>{{ $responsibility }}</li>
              @endforeach
            </ul>
          </div>
          @endforeach
        </div>

        <!-- Education Section -->
        <div class="resume-section" data-aos="fade-up" data-aos-delay="100">
          <h3><i class="bi bi-mortarboard me-2"></i>Education</h3>

          @foreach($education as $edu)
          <div class="resume-item">
            <h4>{{ $edu['degree'] }}</h4>
            <h5>{{ $edu['period'] }}</h5>
            <p class="company"><i class="bi bi-building"></i> {{ $edu['institution'] }}</p>
            <p>{{ $edu['description'] }}</p>
          </div>
          @endforeach
        </div>

        <!-- Certifications Section -->
        <div class="resume-section" data-aos="fade-up" data-aos-delay="200">
          <h3><i class="bi bi-award me-2"></i>Certifications</h3>

          @foreach($certifications as $cert)
          <div class="resume-item">
            <h4>{{ $cert['title'] }}</h4>
            <h5>{{ $cert['year'] }}</h5>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section><!-- /Resume Section -->
@endsection