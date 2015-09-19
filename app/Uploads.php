<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{

    /**
     * Allow table columns to be mass assigned
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'filename',
        'extension',
        'mime_type',
        'path',
    ];

    /**
     * Each upload is created by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(){
        return $this->belongsTo('App\User');
    }

}
