@extends('app')

@section('contentheader_title')
    New Ticket
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            {!! Form::open(['route' => 'tickets.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add ticket', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection