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
                        @include('tickets.partials._table')
                    @endif
                </div>
            </div>
        @endforeach

    </div>

@endsection