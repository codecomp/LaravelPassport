@extends('app')

@section('contentheader_title')
    Users
@endsection

@section('content')

	{!! link_to_route('users.create', 'New Ticket') !!}

	@foreach ($users as $user)

	@endforeach
@endsection