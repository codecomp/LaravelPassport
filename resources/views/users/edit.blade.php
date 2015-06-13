@extends('app')

@section('contentheader_title')
    Update User
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH']) !!}

                @include('users.partials.form', ['buttonText' => 'Update', 'password' => 'Update password (optional)'])

            {!! Form::close() !!}

        </div>
    </div>

@endsection