<div id="fixedBackground"></div>

<div class="mobileNav">
  <div class="mobileNav--left">
    <a href="#" id="showNav"><i class="icon-menu"></i><span>Menu</span></a>
  </div>
  <div class="mobileNav--center"></div>
  <div class="mobileNav--right">

  </div>
</div>

<div class="wrapper">

<div class="sidebarMobileScroll">
<div class="sidebar" id="sidebar">
    <div class="sidebar--logo">
        <a href="{{url('/')}}"><img src="{{url('public/images/logo.png')}}" alt=""></a>
    </div>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Klasa</p>
        <ul>
        @foreach($schoolrooms as $schoolroom)
            <li class="{{ ($active_schoolroom == $schoolroom->schoolroom_id) ? 'active' : '' }}"><a href="{{ url('index/'.$schoolroom->schoolroom_id.'/A') }}">{{ $schoolroom->schoolroom_name }}</a></li>
        @endforeach
        </ul>
    </nav>

    <footer class="sidebar--footer">
        <ul>
        <li><a href="{{ url('/') }}">Rozkład zajęć</a></li>
        @if (auth()->user())
            <li><a href="{{ url('logout') }}">Wyloguj się</a></li>
        @else
            <li><a href="{{ url('login') }}">Zaloguj się</a></li>
        @endif
        </ul>

        <p class="sidebar--footer--copyright">&copy; Copyright 2019</p>
    </footer>
  </div>
</div>
