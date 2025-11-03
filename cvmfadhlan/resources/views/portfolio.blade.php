@extends('layouts.app')

@section('content')
<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Portfolio</h2>
    <p>Explore my latest projects and creative works</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <div class="row">
        <div class="col-lg-3 filter-sidebar">
          <div class="filters-wrapper" data-aos="fade-right" data-aos-delay="150">
            <ul class="portfolio-filters isotope-filters">
              @foreach($categories as $category)
              <li data-filter="{{ $category['slug'] == '*' ? '*' : '.filter-'.$category['slug'] }}" 
                  class="{{ $loop->first ? 'filter-active' : '' }}">
                {{ $category['name'] }}
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="col-lg-9">
          <div class="row gy-4 portfolio-container isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach($projects as $project)
            <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-{{ $project['category'] }}">
              <div class="portfolio-wrap">
                <img src="{{ asset($project['image']) }}" class="img-fluid" alt="{{ $project['title'] }}" loading="lazy">
                <div class="portfolio-info">
                  <div class="content">
                    <span class="category">{{ $project['category_name'] }}</span>
                    <h4>{{ $project['title'] }}</h4>
                    <div class="portfolio-links">
                      <a href="{{ asset($project['image']) }}" class="glightbox" title="{{ $project['title'] }}">
                        <i class="bi bi-plus-lg"></i>
                      </a>
                      <a href="{{ $project['link'] }}" title="More Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Portfolio Section -->
@endsection