@extends('app')

@section('contentheader_title')
    {{ $client->name  }}: New Website
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::open(['route' => ['clients.websites.store', $client->id], 'autocomplete' => 'off']) !!}

                @include('websites.partials._form')

            {!! Form::close() !!}

        </div>
    </div>

@endsection