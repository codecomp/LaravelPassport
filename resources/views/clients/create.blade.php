@extends('app')

@section('contentheader_title')
    New Client
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::open(['route' => 'clients.store', 'autocomplete' => 'off']) !!}

                @include('clients.partials._form')

            {!! Form::close() !!}

        </div>
    </div>

@endsection