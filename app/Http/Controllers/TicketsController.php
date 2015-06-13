<?php namespace App\Http\Controllers;

use App\Client;
use App\Ticket;
use App\TicketComment;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class TicketsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Auth::user()->hasRole(['admin', 'manager']) ){
            $clients = Client::with('tickets.comments.user')->orderBy('updated_at', 'DESC')->get();
        } else {
            $clients = Client::where('id', '=', Auth::user()->client_id)->with('tickets.comments.user')->orderBy('updated_at', 'DESC')->get();
        }

		return view('tickets.index')->with('clients', $clients);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( !Auth::user()->can('add_tickets') )
			return response('Unauthorised', 403);

		return view('tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if ( !Auth::user()->can('add_tickets') )
			return response('Unauthorised', 403);

		//Create a ticket from the request data
		$ticket = new Ticket();
		$ticket->title = $request->input('title');
		$ticket->client_id = 1; //TODO set to current clients ID
		$ticket->save();

		//Add a new comment and assign it to the new ticket
		$comment = new TicketComment();
		$comment->content = $request->input('description');
		$comment->ticket_id = $ticket->id;
		$comment->user_id = Auth::user()->id;
		$comment->save();

        Flash::success('Ticket created successfully');

		//Run the index method to display all the tickets
		return redirect()->route('tickets.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = Ticket::with('comments.user')->FindOrFail($id);

		return view('tickets.show', compact('ticket'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ( !Auth::user()->can('delete_tickets') )
			return response('Unauthorised', 403);

		$ticket = Ticket::FindOrFail($id)->delete();

        Flash::success('Ticket deleted successfully');

		//Run the index
		return redirect()->route('tickets.index');
	}

}
