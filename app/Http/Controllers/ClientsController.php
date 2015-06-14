<?php namespace App\Http\Controllers;

use App\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( !Auth::user()->can('view_clients') )
			return response('Unauthorised', 403);

		$clients = Client::all();

		return view('clients.index')->with('clients', $clients);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( !Auth::user()->can('add_clients') )
			return response('Unauthorised', 403);

		return view('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if ( !Auth::user()->can('add_clients') )
			return response('Unauthorised', 403);

		//Create a client from the request data
		$client = Client::create( $request->all() );

        Flash::success('Client added successfully');

		//Run the index method to display all the tickets
		return redirect()->route('clients.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if ( !Auth::user()->can('view_clients') )
            return response('Unauthorised', 403);

        $client  = Client::with('websites', 'tickets.comments.user')->FindorFail($id);

        return view('clients.show')->with('client', $client);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if ( !Auth::user()->can('edit_clients') )
			return response('Unauthorised', 403);

		$client  = Client::FindorFail($id);

		return view('clients.edit')->with('client', $client);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		if ( !Auth::user()->can('edit_clients') )
			return response('Unauthorised', 403);

		$client  = Client::FindorFail($id);

		//Update a client from the request data
		$client->update( $request->all() );

        Flash::success('Client updated successfully');

		//Re render edit page
		return $this->edit( $id );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ( !Auth::user()->can('delete_clients') )
			return response('Unauthorised', 403);

		$client = Client::FindOrFail($id)->delete();

        Flash::success('Client deleted successfully');

		//Run the index
		return redirect()->route('clients.index');
	}

}
