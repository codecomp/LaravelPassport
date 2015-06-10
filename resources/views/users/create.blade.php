@extends('app')

@section('contentheader_title')
    New User
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::open(['route' => 'users.store', 'autocomplete' => 'off']) !!}

                @include('users.partials.form')

            {!! Form::close() !!}

        </div>
    </div>

@endsection