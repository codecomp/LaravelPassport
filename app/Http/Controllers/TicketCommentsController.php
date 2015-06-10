<?php namespace App\Http\Controllers;

use App\TicketComment;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $ticket_id)
	{
		//if ( !Auth::user()->can('add_comment') )
		//	return response('Unauthorised', 401); //TODO move to routes?

		//Add a new comment and assign it to the new ticket
		$comment = new TicketComment();
		$comment->content 	= $request->input('reply');
		$comment->ticket_id = $ticket_id; //TODO make sure ticket exists
		$comment->user_id 	= Auth::user()->id;
		$comment->save();

		//TODO Update updated_at timestamp on ticket

		return redirect()->route('tickets.show', [$ticket_id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
