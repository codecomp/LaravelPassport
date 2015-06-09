@extends('app')

@section('contentheader_title')
    New User
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::open(['route' => 'users.store', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email address', ['class' => 'control-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password2', 'Repeat Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password2', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add user', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection