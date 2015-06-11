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
		if ( !Auth::user()->can('view_users') )
			return response('Unauthorised', 403);

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
		if ( !Auth::user()->can('add_users') )
			return response('Unauthorised', 403);

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
		if ( !Auth::user()->can('add_users') || !Auth::user()->can('assign_roles') )
			return response('Unauthorised', 403);

		//Make sure the password match
		if( $request->input('password') !== $request->input('password2') )
			return redirect()->back(); //TODO add message

		$user = User::create(array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		));

		//Assign user role
		$role = Role::where('name', '=', $request->input('role'))->first();
		$user->attachRole($role->id);

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
		if ( Auth::user()->id != $id && !Auth::user()->can('edit_users') )
			return response('Unauthorised', 403);

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
		if ( Auth::user()->id != $id && !Auth::user()->can('edit_users') )
			return response('Unauthorised', 403);

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

		//If the user cna assign roles w cn update the role with the post data
		if( Auth::user()->can('assign_roles') ){
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
		if ( !Auth::user()->can('delete_users') )
			return response('Unauthorised', 403);

		$user = User::FindOrFail($id)->delete();

		//Run the index
		return redirect()->route('users.index');
	}

}
