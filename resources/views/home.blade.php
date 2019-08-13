@extends('layouts.home_design')

@section('content')

  <main class="content">
  <div class="content--title">
      <div class="row">
      <div class="col-xl-6">
          <div class="content--title--left">
          <h4>Rozkład zajęć {{ $schoolroom->schoolroom_name }}</h4>
          </div>
      </div>

      <div class="col-xl-6">
          <div class="content--title--right">
          @if (auth()->user())
              <a href="{{ url('klasy') }}"><i class="icon-settings"></i> Panel zarządzania</a>
              <a href="{{ url('logout') }}"><i class="icon-lock"></i> Wyloguj się</a>
          @else
              <a href="{{ url('login') }}"><i class="icon-lock"></i> Zaloguj się</a>
          @endif
          </div>
      </div>
      </div>
  </div>

  <div class="content--buttons">
      <div class="row">
      <div class="col-xl-12 flex">
          <div class="content--buttons--left"></div>
          <div class="content--buttons--center">
          <nav class="component--tabs">
              <ul>
                  <li class="{{ ($active_week == 'A') ? 'active' : '' }}"><a href="{{ url('index/'.$schoolroom->schoolroom_id.'/A') }}">Tydzień A</a></li>
                  <li class="{{ ($active_week == 'B') ? 'active' : '' }}"><a href="{{ url('index/'.$schoolroom->schoolroom_id.'/B') }}">Tydzień B</a></li>
              </ul>
          </nav>
          </div>
          <div class="content--buttons--right"></div>
      </div>
      </div>
  </div>

  <div class="content--main">

      <div class="cd-schedule loading">
          <div class="timeline">
              <ul id="getHeight">
                  <li><span>08:00</span></li>
                  <li><span>08:30</span></li>
                  <li><span>09:00</span></li>
                  <li><span>09:30</span></li>
                  <li><span>10:00</span></li>
                  <li><span>10:30</span></li>
                  <li><span>11:00</span></li>
                  <li><span>11:30</span></li>
                  <li><span>12:00</span></li>
                  <li><span>12:30</span></li>
                  <li><span>13:00</span></li>
                  <li><span>13:30</span></li>
                  <li><span>14:00</span></li>
                  <li><span>14:30</span></li>
                  <li><span>15:00</span></li>
                  <li><span>15:30</span></li>
                  <li><span>16:00</span></li>
                  <li><span>16:30</span></li>
                  <li><span>17:00</span></li>
                  <li><span>17:30</span></li>
                  <li><span>18:00</span></li>
                  <li><span>18:30</span></li>
                  <li><span>19:00</span></li>
                  <li><span>19:30</span></li>
                  <li><span>20:00</span></li>
              </ul>
          </div>

          <div class="events" id="events">
              <ul>
                  <li class="events-group">
                      <div class="top-info"><span>Poniedziałek</span></div>
                      <ul>
                          @foreach($shedules as $shedule)
                              @if($shedule->shedule_week == $active_week && $shedule->shedule_day == '1')
                                  <li class="single-event" data-start="{{ $shedule->shedule_hour_start }}" data-end="{{ $shedule->shedule_hour_end }}">
                                      <span class="shedule">{{ $shedule->shedule_hour_start }} - {{ $shedule->shedule_hour_end }}</span>
                                      <span class="subject">{{ $shedule->subject_name }}</span>
                                      <span class="teacher">{{ $shedule->teacher_name }}</span>
                                      <span class="room">{{ $shedule->room_name }}</span>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </li>

                  <li class="events-group">
                      <div class="top-info"><span>Wtorek</span></div>
                      <ul>
                          @foreach($shedules as $shedule)
                              @if($shedule->shedule_week == $active_week && $shedule->shedule_day == '2')
                              <li class="single-event" data-start="{{ $shedule->shedule_hour_start }}" data-end="{{ $shedule->shedule_hour_end }}">
                                  <span class="shedule">{{ $shedule->shedule_hour_start }} - {{ $shedule->shedule_hour_end }}</span>
                                  <span class="subject">{{ $shedule->subject_name }}</span>
                                  <span class="teacher">{{ $shedule->teacher_name }}</span>
                                  <span class="room">{{ $shedule->room_name }}</span>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </li>

                  <li class="events-group">
                      <div class="top-info"><span>Środa</span></div>
                      <ul>
                          @foreach($shedules as $shedule)
                              @if($shedule->shedule_week == $active_week && $shedule->shedule_day == '3')
                              <li class="single-event" data-start="{{ $shedule->shedule_hour_start }}" data-end="{{ $shedule->shedule_hour_end }}">
                                <span class="shedule">{{ $shedule->shedule_hour_start }} - {{ $shedule->shedule_hour_end }}</span>
                                <span class="subject">{{ $shedule->subject_name }}</span>
                                <span class="teacher">{{ $shedule->teacher_name }}</span>
                                <span class="room">{{ $shedule->room_name }}</span>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </li>

                  <li class="events-group">
                      <div class="top-info"><span>Czwartek</span></div>
                      <ul>
                          @foreach($shedules as $shedule)
                              @if($shedule->shedule_week == $active_week && $shedule->shedule_day == '4')
                              <li class="single-event" data-start="{{ $shedule->shedule_hour_start }}" data-end="{{ $shedule->shedule_hour_end }}">
                                <span class="shedule">{{ $shedule->shedule_hour_start }} - {{ $shedule->shedule_hour_end }}</span>
                                <span class="subject">{{ $shedule->subject_name }}</span>
                                <span class="teacher">{{ $shedule->teacher_name }}</span>
                                <span class="room">{{ $shedule->room_name }}</span>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </li>

                  <li class="events-group">
                      <div class="top-info"><span>Piątek</span></div>
                      <ul>
                          @foreach($shedules as $shedule)
                              @if($shedule->shedule_week == $active_week && $shedule->shedule_day == '5')
                              <li class="single-event" data-start="{{ $shedule->shedule_hour_start }}" data-end="{{ $shedule->shedule_hour_end }}">
                                <span class="shedule">{{ $shedule->shedule_hour_start }} - {{ $shedule->shedule_hour_end }}</span>
                                <span class="subject">{{ $shedule->subject_name }}</span>
                                <span class="teacher">{{ $shedule->teacher_name }}</span>
                                <span class="room">{{ $shedule->room_name }}</span>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </li>
              </ul>
          </div>


      </div>

  </div>

  </main>
</div>

@endsection
