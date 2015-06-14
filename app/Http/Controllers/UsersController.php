<?php namespace App\Http\Controllers;

use App\Client;
use App\Role;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

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

		$users = User::with('roles')->get();

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

		$clients 	= Client::lists('name', 'id')->all();
		$roles 		= Role::lists('display_name', 'id')->all();

		return view('users.create')->with(['clients' => $clients, 'roles' => $roles]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if ( !Auth::user()->can('add_users') )
			return response('Unauthorised', 403);

		if( $request->input('client') && !Auth::user()->can('assign_clients') )
			return response('Unauthorised', 403);

		if( $request->input('role') && !Auth::user()->can('assign_roles') )
			return response('Unauthorised', 403);

		//Make sure the password match
		if( $request->input('password') !== $request->input('password2') )
			return redirect()->back(); //TODO add message

		//Create the user
		$user = User::create(array(
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		));

		if( $request->input('client_id') ){
			//Assign user client
			$client = Role::where('id', '=', $request->input('client_id'))->first();
			$user->client()->associate($client);
			$user->save();
		}

		if( $request->input('role') ){
			//Assign user role
			$role = Role::where('id', '=', $request->input('role'))->first();
			$user->attachRole($role->id);
			$user->save();
		}

        Flash::success('User created successfully');

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

		$user  	 = User::FindorFail($id);
		$clients = Client::lists('name', 'id')->all();
		$roles 	 = Role::lists('display_name', 'id')->all();

		return view('users.edit')->with(['user' => $user, 'clients' => $clients, 'roles' => $roles, 'role_id' => $user->roles()->first()->id ]);
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

		//If the user cna assign roles we update the role with the post data
		if( Auth::user()->can('assign_clients') ){
			$client = Role::where('id', '=', $request->input('client_id'))->first();
			$user->client()->associate($client);
		}

		//If the user cna assign roles we update the role with the post data
		if( Auth::user()->can('assign_roles') ){
			//Remove all existing roles
			$user->roles()->detach();

			//Update role
			$role = Role::where('id', '=', $request->input('role'))->first();
			$user->roles()->attach($role);
		}

		$user->save();

        Flash::success('User updated successfully');

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

        Flash::success('User deleted successfully');

		//Run the index
		return redirect()->route('users.index');
	}

}
