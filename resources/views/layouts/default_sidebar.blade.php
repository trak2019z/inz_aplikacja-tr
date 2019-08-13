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
        <p class="sidebar--nav--title">Rozkład zajęć</p>
        <ul>
        <li class="{{ request()->is('klasy*') ||  request()->is('rozklad*') ? 'active' : '' }}"><a href="{{ url('klasy') }}"><i class="icon-calendar"></i> Klasy</a></li>
        </ul>
    </nav>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Dane</p>
        <ul>
        <li class="{{ request()->is('nauczyciele*') ? 'active' : '' }}"><a href="{{ url('nauczyciele') }}"><i class="icon-user"></i> Nauczyciele</a></li>
        <li class="{{ request()->is('przedmioty*') ? 'active' : '' }}"><a href="{{ url('przedmioty') }}"><i class="icon-layers"></i> Przedmioty</a></li>
        <li class="{{ request()->is('pokoje*') ? 'active' : '' }}"><a href="{{ url('pokoje') }}"><i class="icon-login"></i> Pokoje</a></li>
        </ul>
    </nav>

    <nav class="sidebar--nav">
        <p class="sidebar--nav--title">Ustawienia</p>
        <ul>
        <li class="{{ request()->is('uzytkownicy*') ? 'active' : '' }}"><a href="{{ url('uzytkownicy') }}"><i class="icon-user"></i> Użytkownicy</a></li>
        <li class="{{ request()->is('ustawienia*') ? 'active' : '' }}"><a href="{{ url('ustawienia') }}"><i class="icon-layers"></i> Ustawienia</a></li>
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
