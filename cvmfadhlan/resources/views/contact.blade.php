@extends('layouts.app')

@section('content')
<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>Get in touch with me for collaborations and inquiries</p>
  </div>

  <div class="container">
    <div class="row g-4 g-lg-5">
      <div class="col-lg-5">
        <div class="info-box">
          <h3>Contact Info</h3>
          <p>Feel free to reach out through any of the following channels.</p>

          @foreach($contact_info as $info)
          <div class="info-item">
            <div class="icon-box">
              <i class="bi {{ $info['icon'] }}"></i>
            </div>
            <div class="content">
              <h4>{{ $info['title'] }}</h4>
              @foreach($info['lines'] as $line)
              <p>{{ $line }}</p>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-form">
          <h3>Get In Touch</h3>
          <p>Send me a message and I'll get back to you as soon as possible.</p>

          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif

          @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('contact.submit') }}" method="POST" class="php-email-form">
            @csrf
            <div class="row gy-4">
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
              </div>

              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
              </div>

              <div class="col-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
              </div>

              <div class="col-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required>{{ old('message') }}</textarea>
              </div>

              <div class="col-12 text-center">
                <button type="submit" class="btn">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Contact Section -->
@endsection