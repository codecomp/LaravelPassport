<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

	/**
	 * Ticket status array of database to readable status
	 *
	 * @var array
	 */
	protected $human_status = [
		0 => 'Open',
		1 => 'Pending',
		2 => 'Complete',
		3 => 'On hold'
	];

	/**
	 * Allow table columns to be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = [
		'title'
	];

	/**
	 * Scope queries to Open tickets
	 *
	 * @param $query
	 */
	public function scopeOpen($query){
		$query->whereIn('status', [0, 1]);
	}

	/**
	 * Scope queries to Completed tickets
	 *
	 * @param $query
	 */
	public function scopeComplete($query){
		$query->whereIn('status', 2);
	}

	/**
	 * Scope queries to On hold tickets
	 *
	 * @param $query
	 */
	public function scopeOnHold($query){
		$query->whereIn('status', 3);
	}

	/**
	 * Each ticket belongs to a client
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client(){
		return $this->belongsTo('App\Client');
	}

	/**
	 * A Ticket has many ticket comments
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments(){

		return $this->hasMany('App\TicketComment');

	}

}
