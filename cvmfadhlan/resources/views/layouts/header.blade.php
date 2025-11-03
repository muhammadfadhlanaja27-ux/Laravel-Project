<header id="header" class="header dark-background d-flex flex-column justify-content-center">
  <i class="header-toggle d-xl-none bi bi-list"></i>

  <div class="header-container d-flex flex-column align-items-start">
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
          <i class="bi bi-house navicon"></i>Home</a>
        </li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
          <i class="bi bi-person navicon"></i> About</a>
        </li>
        <li><a href="{{ route('resume') }}" class="{{ request()->routeIs('resume') ? 'active' : '' }}">
          <i class="bi bi-file-earmark-text navicon"></i> Resume</a>
        </li>
        <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio*') ? 'active' : '' }}">
          <i class="bi bi-images navicon"></i> Portfolio</a>
        </li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
          <i class="bi bi-envelope navicon"></i> Contact</a>
        </li>
      </ul>
    </nav>

    <div class="social-links text-center">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>
  </div>
</header>