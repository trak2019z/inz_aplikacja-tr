@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">Użytkownicy
        <div class="content--title--left">
        <h4>Dodaj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li><a href="{{ url('uzytkownicy') }}">Użytkownicy</a></li>
            <li class="active"><a href="{{ url('uzytkownicy/dodaj') }}">Dodaj użytkownika</a></li>
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
            <form method="POST" action="{{ url('uzytkownicy/dodaj') }}" >
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Imię i nazwisko</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasło</label>
                    <input type="password" class="form-control" name="password">
                </div>
                @if (Auth::user()->role == 'admin')   
                <div class="form-group">
                    <label for="exampleInputEmail1">Rola</label>

                    <select class="custom-select" name="role">
                        <option value="admin">Administrator</option>
                        <option value="moderator">Moderator</option>
                    </select>
                </div>
                @endif
                <button type="submit" class="btn-md btn-primary">Dodaj użytkownika</button>
                <a href="{{ url('uzytkownicy') }}" class="btn-md btn-grey">Anuluj</a>
            </form>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

</main>

@endsection
    