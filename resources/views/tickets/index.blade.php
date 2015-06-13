@extends('app')

@section('contentheader_title')
    Tickets
@endsection

@section('content')

	{!! link_to_route('tickets.create', 'New Ticket', null, ['class' => 'btn btn-primary']) !!}


    <div class="panel-group">

        @foreach( $clients as $client )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>{{ $client->name  }}</p>
                </div>
                <div class="panel-body">
                    @if( ! $client->tickets->count() )
                        <p class="panel-empty-message">No tickets</p>
                    @else
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
                            @foreach ($client->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->get_human_status( $ticket->status ) }}</td>
                                    <td>{!! link_to_route('tickets.show', $ticket->title, $ticket->id) !!}</td>
                                    <td>{{ $ticket->comments[0]->user->name  }}</td>
                                    <td>{{ $ticket->created_at->diffForHumans()  }}</td>
                                    <td>{{ $ticket->updated_at->diffForHumans()  }}</td>
                                    <td>
                                        <!-- TODO Tie in functionality -->
                                        <div class="dropdown pull-left">
                                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="statusbutton{{ $client->id }}" data-toggle="dropdown">Status <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="statusbutton{{ $client->id }}">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Open</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Pending</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">On Hold</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Complete</a></li>
                                            </ul>
                                        </div>
                                        {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'DELETE', 'class' => 'pull-left']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm-delete']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

@endsection