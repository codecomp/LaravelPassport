@extends('app')

@section('contentheader_title')
    Update Client
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PATCH']) !!}

                @include('clients.partials._form', ['buttonText' => 'Update'])

            {!! Form::close() !!}

        </div>
    </div>

@endsection