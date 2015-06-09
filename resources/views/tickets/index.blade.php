@extends('app')

@section('contentheader_title')
    Tickets
@endsection

@section('content')

	{!! link_to_route('tickets.create', 'New Ticket', null, ['class' => 'btn btn-primary']) !!}

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Status</th>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->get_human_status( $ticket->status ) }}</td>
                <td><a href="{{ action('TicketsController@show', [$ticket->id]) }}">{{ $ticket->title }}</a></td>
                <td>{{ $ticket->comments[0]->user->name  }}</td>
                <td>{{ $ticket->created_at  }}</td>
                <td>{{ $ticket->updated_at  }}</td>
                <td><!-- TODO Add actions --></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection