@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section">
  <div class="background-elements">
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
  </div>

  <div class="hero-content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
          <div class="hero-text">
            <h1>Porto<span class="accent-text">Folio</span></h1>
            <h2>{{ $hero['name'] }}</h2>
            <p class="lead">I'm a <span class="typed" data-typed-items="{{ implode(',', $hero['roles']) }}"></span></p>
            <p class="description">{{ $hero['description'] }}</p>

            <div class="hero-actions">
              <a href="{{ route('portfolio') }}" class="btn btn-primary">View My Work</a>
              <a href="{{ route('contact') }}" class="btn btn-outline">Get In Touch</a>
            </div>

            <div class="social-links">
              <a href="#"><i class="bi bi-dribbble"></i></a>
              <a href="#"><i class="bi bi-behance"></i></a>
              <a href="https://github.com/muhammadfadhlanaja27-ux" target="_blank"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/muhammad-fadhlan-pratama-317001379/" target="_blank"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
          <div class="hero-visual">
            <div class="profile-container">
              <div class="profile-background"></div>
              <img src="{{ asset($hero['image']) }}" alt="{{ $hero['name'] }}" class="profile-image">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Hero Section -->

<!-- Stats Section -->
<section id="stats" class="stats section light-background">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="stats-wrapper">
          @foreach($stats as $index => $stat)
          <div class="stats-item" data-aos="zoom-in" data-aos-delay="{{ 150 + ($index * 50) }}">
            <div class="icon-wrapper">
              <i class="bi {{ $stat['icon'] }}"></i>
            </div>
            <span data-purecounter-start="0" data-purecounter-end="{{ $stat['number'] }}" data-purecounter-duration="1" class="purecounter"></span>
            <p>{{ $stat['label'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section><!-- /Stats Section -->
@endsection