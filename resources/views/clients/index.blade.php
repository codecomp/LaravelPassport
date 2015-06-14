@extends('app')

@section('contentheader_title')
    Clients
@endsection

@section('content')

    @if( Auth::user()->can('add_clients') )
        {!! link_to_route('clients.create', 'New Client', null, ['class' => 'btn btn-primary']) !!}
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            @if( Auth::user()->can(['edit_clients', 'add_websites', 'delete_clients']) )
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{!! link_to_route('clients.show', $client->name, $client->id) !!}</td>
                <td>{{ $client->created_at->diffForHumans()  }}</td>
                <td>{{ $client->updated_at->diffForHumans()  }}</td>
                @if( Auth::user()->can(['edit_clients', 'add_websites', 'delete_clients']) )
                    <td>
                        @if( Auth::user()->can(['edit_clients', 'add_websites']) )
                            <div class="dropdown pull-left">
                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="statusbutton{{ $client->id }}" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="statusbutton{{ $client->id }}">
                                    @if( Auth::user()->can('edit_clients') )
                                        <li role="presentation">{!! link_to_route('clients.edit', 'Edit', $client->id, ['class' => 'menuitem']) !!}</li>
                                    @endif
                                    @if( Auth::user()->can('add_websites') )
                                        <li role="presentation">{!! link_to_route('clients.websites.create', 'Create website', $client->id, ['class' => 'menuitem']) !!}</li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if( Auth::user()->can('delete_clients') )
                            {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm-delete']) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection