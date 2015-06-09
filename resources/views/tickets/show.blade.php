@extends('app')

@section('contentheader_title')
    Ticket: #{{ $ticket->id }}
@endsection

@section('content')
	<article>

        <div class="comments">
            @foreach($ticket->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }}</strong></p>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>

        {!! Form::open([ 'route' => ['tickets.comments.store', $ticket->id] ]) !!}
            {!! Form::hidden('ticket_id', $ticket->id) !!}

            {!! Form::label('reply', 'Reply') !!}
            {!! Form::textarea('reply', null) !!}

            {!! Form::submit('Add reply') !!}

        {!! Form::close() !!}

    </article>
@endsection