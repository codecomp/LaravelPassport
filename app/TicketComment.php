<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model {

	/**
	 * Comment type array of database to readable types
	 *
	 * @var array
	 */
	private $human_type = array(
		0 => 'Public',
		1 => 'Internal'
	);

	/**
	 * Allow table columns to be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = [
		'content',
		'attachments'
	];

	/**
	 * A ticket comment belongs to a ticket
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ticket(){
		return $this->belongsTo('App\Ticket');
	}

	/**
	 * A ticket comment belongs to a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(){
		return $this->belongsTo('App\User');
	}

}
