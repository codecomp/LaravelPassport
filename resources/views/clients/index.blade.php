@extends('app')

@section('contentheader_title')
    Clients
@endsection

@section('content')

    {!! link_to_route('clients.create', 'New Client', null, ['class' => 'btn btn-primary']) !!}

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{!! link_to_route('clients.show', $client->name, $client->id) !!}</td>
                <td>{{ $client->created_at->diffForHumans()  }}</td>
                <td>{{ $client->updated_at->diffForHumans()  }}</td>
                <td>
                    <div class="dropdown pull-left">
                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="statusbutton{{ $client->id }}" data-toggle="dropdown">Actions <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="statusbutton{{ $client->id }}">
                            <li role="presentation">{!! link_to_route('clients.edit', 'Edit', $client->id, ['class' => 'menuitem']) !!}</li>
                            <li role="presentation">{!! link_to_route('clients.websites.create', 'Create website', $client->id, ['class' => 'menuitem']) !!}</li>
                        </ul>
                    </div>
                    {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm-delete']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection