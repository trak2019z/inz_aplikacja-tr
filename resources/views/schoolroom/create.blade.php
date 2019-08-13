@extends('layouts.default_design')

@section('content')

<main class="content">
<div class="content--title">
    <div class="row">
    <div class="col-xl-6">
        <div class="content--title--left">
        <h4>Dodaj</h4>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content--title--right">
        <ul class="content--title--right--breadcrumb">
            <li><a href="{{ url('klasy') }}">Klasy</a></li>
            <li class="active"><a href="{{ url('klasy/dodaj') }}">Dodaj klase</a></li>
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
            <form method="POST" action="{{ url('klasy/dodaj') }}" >
            @csrf
                <div class="form-group">
                <label for="exampleInputEmail1">Nazwa klasy</label>
                <input type="text" class="form-control" name="schoolroom_name">
                </div>
                <button type="submit" class="btn-md btn-primary">Dodaj klase</button>
                <a href="{{ url('klasy') }}" class="btn-md btn-grey">Anuluj</a>
            </form>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

</main>

@endsection
    