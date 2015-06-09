<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	/**
	 * Allow table columns to be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Clients have many tickets
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tickets(){
		return $this->hasMany('App\Ticket');
	}

}
