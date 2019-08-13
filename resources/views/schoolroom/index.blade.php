@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Klasy</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li class="active"><a href="{{ url('klasy') }}">Klasy</a></li>
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
        <div class="content--buttons--right">
        <a href="{{ url('klasy/dodaj') }}" class="btn btn-primary btn-md"><i class="icon-plus"></i> Dodaj klase</a>
        </div>
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
                <th>Nazwa</th>
                <th>Rozkład zajęć</th>
                <th>Akcja</th>
            </tr>
            </thead>
            <tbody id="fbody">
            @foreach($schoolrooms as $schoolroom)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $schoolroom->schoolroom_name }}</td>
                <td><a href="{{ url('rozklad/'.$schoolroom->schoolroom_id.'/A' ) }}" class="btn btn-sm btn-primary">Rozkład zajęć</a></td>
                <td class="action">
                <a href="{{ url('klasy/edytuj/'.$schoolroom->schoolroom_id ) }}"><i class="icon-pencil"></i></a>
                <a href="javascript:;" class="remove-record" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ url('klasy/usun/'.$schoolroom->schoolroom_id )}}" data-id="{{ $schoolroom->schoolroom_id }}" data-name="{{ $schoolroom->schoolroom_name }}"><i class="icon-trash"></i></a>
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