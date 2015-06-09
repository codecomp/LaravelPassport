<?php namespace App\Http\Controllers;

use App\Ticket;
use App\TicketComment;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$tickets = Ticket::all();
		$tickets = Ticket::latest()->get();

		return view('tickets.index')->with('tickets', $tickets);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( !Auth::user()->can('add_ticket') )
			//return response('Unauthorised', 401); //TODO Move to routes?

		return view('tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if ( !Auth::user()->can('add_ticket') )
			//return response('Unauthorised', 401); //TODO Move to routes?

		//Create a ticket from the request data
		$ticket = new Ticket();
		$ticket->title = $request->input('title');
		$ticket->client_id = 1; //TODO set to current clients ID
		$ticket->save();

		//Add a new comment and assign it to the new ticket
		$comment = new TicketComment();
		$comment->content = $request->input('description');
		$comment->ticket_id = $ticket->id;
		$comment->user_id = 1; //TODO set to current users ID
		$comment->save();

		//Run the index method to display all the tickets
		return $this->index();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket 	= Ticket::with('comments.user')->FindOrFail($id);

		return view('tickets.show', compact('ticket'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
