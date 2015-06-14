@extends('app')

@section('contentheader_title')
    {{ $client->name  }}
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Notes</p>
                </div>
                <div class="panel-body">
                    <p>{{ $client->notes  }}</p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Websites</p>
                </div>
                <div class="panel-body">
                    {!! link_to_route('clients.websites.create', 'Create website', $client->id, ['class' => 'btn btn-primary']) !!}
                    @if( ! $client->websites->count() )
                        <p class="panel-empty-message">No websites</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>FTP Host</th>
                                    <th>FTP Username</th>
                                    <th>FTP Password</th>
                                    <th>SSH Host</th>
                                    <th>SSH Username</th>
                                    <th>SSH Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $client->websites as $website )
                                <tr>
                                    <td>{{ $website->url }}</td>
                                    <td>{{ $website->ftp_host }}</td>
                                    <td>{{ $website->ftp_username }}</td>
                                    <td>{{ $website->ftp_password }}</td>
                                    <td>{{ $website->ssh_host }}</td>
                                    <td>{{ $website->ssh_username }}</td>
                                    <td>{{ $website->ssh_password }}</td>
                                    <td>
                                        {!! link_to_route('clients.websites.edit', 'Edit', [$client->id, $website->id], ['class' => 'btn btn-xs btn-primary  pull-left']) !!}

                                        {!! Form::open(['route' => ['clients.websites.destroy', $client->id, $website->id], 'method' => 'DELETE', 'class' => 'pull-left']) !!}
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Tickets</p>
                </div>
                <div class="panel-body">
                    @if( ! $client->tickets->count() )
                        <p class="panel-empty-message">No tickets</p>
                    @else
                        @include('tickets.partials._table')
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection