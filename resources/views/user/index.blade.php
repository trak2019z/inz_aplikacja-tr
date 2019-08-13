@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Użytkownicy</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li class="active"><a href="{{ url('uzytkownicy') }}">Użytkownicy</a></li>
        </ul>
        </div>
    </div>
    </div>
</div>

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

<div class="content--buttons">
    <div class="row">
    <div class="col-xl-12">
        @if(Auth::user()->role == 'admin')
        <div class="content--buttons--right">
        <a href="{{ url('uzytkownicy/dodaj') }}" class="btn btn-primary btn-md"><i class="icon-plus"></i> Dodaj użytkownika</a>
        </div>
        @endif
    </div>
    </div>
</div>

<div class="content--main">
    <div class="row">
    <div class="col-xl-12">
        <div class="component--search">
        <form action="">
            <input type="text" placeholder="Szukaj..." id="searchInput">
        </form>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="component--table">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Imię i nazwisko</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Akcja</th>
            </tr>
            </thead>
            <tbody id="fbody">
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ($user->role == 'admin') ? 'Administrator' : 'Moderator' }}</td>
                <td class="action">
                <a href="{{ url('uzytkownicy/edytuj/'.$user->id ) }}"><i class="icon-pencil"></i></a>
                @if(Auth::user()->role == 'admin')
                    <a href="javascript:;" class="remove-record" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ url('uzytkownicy/usun/'.$user->id )}}" data-id="{{ $user->id }}" data-name="{{ $user->name }}"><i class="icon-trash"></i></a>
                @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

</main>

<form action="" method="POST" class="remove-record-model">
@csrf
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Usunąć <strong><span class="modal-name"></span></strong>?</h5>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn-md btn-danger">Tak, usuwam</button>
            <button type="button" class="btn-md btn-grey remove-record-model" data-dismiss="modal">Anuluj</button>
        </div>
        </div>
    </div>
</div>
</form>

@endsection