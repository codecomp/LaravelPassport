<?php namespace App;

use Zizaco\Entrust\EntrustRole;

use Illuminate\Support\Facades\Auth;

class Role extends EntrustRole{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'display_name', 'description'];

    static function assignableRoles(){
        $exclude = array();

        //Stop non admins from assigning admin role
        if ( !Auth::user()->hasRole('admin') )
            $exclude[] = 'admin';

        return Role::whereNotIn('name', $exclude)->lists('display_name', 'id');
    }
}