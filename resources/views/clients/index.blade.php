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
                <td>{!! link_to_route('clients.edit', $client->name, $client->id) !!}</td>
                <td>{{ $client->created_at->diffForHumans()  }}</td>
                <td>{{ $client->updated_at->diffForHumans()  }}</td>
                <td>
                    <!-- TODO Simplify actions -->
                    {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection