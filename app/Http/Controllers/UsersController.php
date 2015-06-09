<?php namespace App\Http\Controllers;

use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

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
		//TODO check for authentication
		//if ( !Auth::user()->can('add_users') )
		//	return response('Unauthorised', 401); //TODO Move to routes?

		$user = new User();

		return view('users.create')->with('user', $user);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Make sure the password match
		if( $request->input('password') !== $request->input('password2') )
			return redirect()->back();

		$user = User::create(array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('email'))
		));

		//Run the index method to display all the users
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
