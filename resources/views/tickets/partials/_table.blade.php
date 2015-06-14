<table class="table table-striped">
    <thead>
    <tr>
        <th>Status</th>
        <th>Title</th>
        <th>Author</th>
        <th>Created</th>
        <th>Updated</th>
        @if( Auth::user()->can(['close_tickets', 'delete_tickets']) )
            <th>Actions</th>
        @endif
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
            @if( Auth::user()->can(['close_tickets', 'delete_tickets']) )
                <td>
                    @if( Auth::user()->can('close_tickets') )
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
                    @endif
                    @if( Auth::user()->can('delete_tickets') )
                        {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm-delete']) !!}
                        {!! Form::close() !!}
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>