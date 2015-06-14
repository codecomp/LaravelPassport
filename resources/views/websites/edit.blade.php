@extends('app')

@section('contentheader_title')
    Update Website
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::model($website, ['route' => ['clients.websites.update', $client->id, $website->id], 'method' => 'PATCH']) !!}

                @include('websites.partials._form', ['buttonText' => 'Update', 'password_ftp' => 'Update FTP Password (optional)', 'password_ssh' => 'Update SSH Password (optional)'])

            {!! Form::close() !!}

        </div>
    </div>

@endsection