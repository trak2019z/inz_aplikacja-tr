@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Edytuj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li><a href="{{ url('klasy') }}">Klasy</a></li>
            <li class="active"><a href="{{ url('klasy/edytuj/'.$schoolroom->schoolroom_id.'/'.$active_week.'/'.$shedule->shedule_id) }}">Edytuj zajęcia</a></li>
        </ul>
        </div>
    </div>
    </div>
</div>

<div class="content--main">

    <div class="row">
    <div class="col-xl-12">

        <div class="component--form">
        <div class="row">
            <div class="col-xl-6">
            @if (Session::has('flash_message_error'))
            <div class="alert alert-danger"> <i class="icon-close"></i> {!! session('flash_message_error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            @endif
            @if (Session::has('flash_message_success'))
            <div class="alert alert-success"> <i class="icon-check"></i> {!! session('flash_message_success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            @endif
            <form method="POST" action="{{ url('rozklad/edytuj/'.$schoolroom->schoolroom_id.'/'.$active_week.'/'.$shedule->shedule_id) }}" >
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Dzień</label>

                    <select class="custom-select" name="shedule_day">
                      <option value="1" {{ ($shedule->shedule_day == '1') ? 'selected' : '' }}>Poniedziałek</option>
                      <option value="2" {{ ($shedule->shedule_day == '2') ? 'selected' : '' }}>Wtorek</option>
                      <option value="3" {{ ($shedule->shedule_day == '3') ? 'selected' : '' }}>Środa</option>
                      <option value="4" {{ ($shedule->shedule_day == '4') ? 'selected' : '' }}>Czwartek</option>
                      <option value="5" {{ ($shedule->shedule_day == '5') ? 'selected' : '' }}>Piątek</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tydzień</label>

                    <select class="custom-select" name="shedule_week">
                      <option value="A" {{ ($shedule->shedule_week == 'A') ? 'selected' : '' }}>A</option>
                      <option value="B" {{ ($shedule->shedule_week == 'B') ? 'selected' : '' }}>B</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Godzina rozpoczęcia</label>

                    <select class="custom-select" name="shedule_hour_start">
                        @for ($i = 8; $i <= 20; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ ($start_hour_pieces[0] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Minuta rozpoczęcia</label>

                    <select class="custom-select" name="shedule_minute_start">
                        @for ($i = 0; $i <= 59; $i = $i + 15)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ ($start_hour_pieces[1] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Godzina zakończenia</label>

                        <select class="custom-select" name="shedule_hour_end">
                            @for ($i = 8; $i <= 20; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ ($end_hour_pieces[0] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Minuta zakończenia</label>

                        <select class="custom-select" name="shedule_minute_end">
                            @for ($i = 0; $i <= 59; $i = $i + 15)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ ($end_hour_pieces[1] == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Przedmiot</label>

                    <select class="custom-select" name="subject_id">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->subject_id }}" {{ ($shedule->subject_id == $subject->subject_id) ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nauczyciel</label>

                    <select class="custom-select" name="teacher_id">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->teacher_id }}" {{ ($shedule->teacher_id == $teacher->teacher_id) ? 'selected' : '' }}>{{ $teacher->teacher_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Pokój</label>

                    <select class="custom-select" name="room_id">
                        @foreach ($rooms as $room)
                            <option value="{{ $room->room_id }}" {{ ($shedule->room_id == $room->room_id) ? 'selected' : '' }}>{{ $room->room_name }}</option>
                        @endforeach
                    </select>
                  </div>


                  <button type="submit" class="btn-md btn-primary">Zapisz zajęcia</button>
                  <a href="{{ url('rozklad/'.$schoolroom->schoolroom_id.'/'.$active_week) }}" class="btn-md btn-grey">Anuluj</a>
            </form>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

</main>

@endsection
