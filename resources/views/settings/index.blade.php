@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">Ustawienia
        <div class="content--title--left">
        <h4>Edytuj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li class="active"><a href="{{ url('ustawienia') }}">Ustawienia</a></li>
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
            <form method="POST" action="{{ url('ustawienia') }}" >
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Adres mail do wysyłki powiadomień</label>
                    <input type="text" class="form-control" name="mail_sender" value="{{ $settings->mail_sender }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nowe hasło temat wiadomości:</label>
                    <input type="text" class="form-control" name="password_reset_notification_subject" value="{{ $settings->password_reset_notification_subject }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nowe Hasło treść wiadomości:</label>
                    <textarea class="form-control" name="password_reset_notification_content">{{ $settings->password_reset_notification_content }}</textarea>
                </div>
                <button type="submit" class="btn-md btn-primary">Zapisz ustawienia</button>
                <a href="{{ url('ustawienia') }}" class="btn-md btn-grey">Anuluj</a>
            </form>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

</main>

@endsection
