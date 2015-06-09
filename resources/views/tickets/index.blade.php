@extends('app')

@section('contentheader_title')
    Tickets
@endsection

@section('content')

	{!! link_to_route('tickets.create', 'New Ticket') !!}

	@foreach ($tickets as $ticket)
		<article>
			<h2><a href="{{ action('TicketsController@show', [$ticket->id]) }}">{{ $ticket->title }}</a></h2>
		</article>
	@endforeach
@endsection