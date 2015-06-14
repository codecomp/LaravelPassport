@extends('app')

@section('contentheader_title')
    Ticket: #{{ $ticket->id }}
@endsection

@section('content')
	<article>

        <p>Status: {{ $ticket->get_human_status( $ticket->status ) }}</p>

        <div class="comments">
            @foreach($ticket->comments as $comment)
                <div class="panel panel-default">
                    <p class="panel-heading">{{ $comment->user->name }}<br/>{{ $comment->created_at->diffForHumans()  }}</p>
                    <p class="panel-body">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>

        @if( Auth::user()->can('add_comments') )
            {!! Form::open([ 'route' => ['tickets.comments.store', $ticket->id] ]) !!}
                {!! Form::hidden('ticket_id', $ticket->id) !!}

                <div class="form-group">
                    {!! Form::label('reply', 'Reply') !!}
                    {!! Form::textarea('reply', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add reply', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        @endif

    </article>
@endsection