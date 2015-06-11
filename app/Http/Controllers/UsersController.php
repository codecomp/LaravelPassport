<?php namespace App\Http\Controllers;

use App\Role;
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
		$users = User::all();

		return view('users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//if ( !Auth::user()->can('add_users') )
		//	return response('Unauthorised', 401); //TODO Move to routes?

		$roles = Role::lists('display_name', 'name');

		return view('users.create')->with('roles', $roles);
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
			return redirect()->back(); //TODO add message

		$user = User::create(array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		));

		//Run the index method to display all the users
		return redirect()->route('users.index');
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
		$user  = User::FindorFail($id);
		$roles = Role::lists('display_name', 'name');

		return view('users.edit')->with(['user' => $user, 'roles' => $roles ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//Setup passwords as variables to check if empty
		$pass 	= $request->input('password');
		$pass2 	= $request->input('password2');

		//Make sure the password match
		if( ( !empty( $pass ) && !empty($pass2) ) && $request->input('password') !== $request->input('password2') )
			return redirect()->back(); //TODO add message

		$user = User::FindorFail($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');

		//Update password
		if( ( !empty( $pass ) && !empty($pass2) ) && $request->input('password') == $request->input('password2') )
			$user->password = bcrypt($request->input('password'));

		//TODO check permissions
		if( true ){
			//Remove all existing roles
			$user->roles()->detach();

			//Update role
			$role = Role::where('name', '=', $request->input('role'))->first();
			$user->attachRole($role->id);
		}

		$user->save();

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
		$user = User::FindOrFail($id)->delete();

		//Run the index
		return redirect()->route('users.index');
	}

}
