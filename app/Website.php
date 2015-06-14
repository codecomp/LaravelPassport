<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

class Website extends Model
{

    /**
     * Don't return attributes unless requested
     *
     * @var array
     */
    protected $hidden = [
        'ftp_password',
        'ssh_password'
    ];

    /**
     * Allow table columns to be mass assigned
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'ip',
    ];

    /**
     * A website belongs to a client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function getFtpPasswordAttribute($value)
    {
        if( in_array($_SERVER['REMOTE_ADDR'], Config::get('app.administrator_ip')) )
            return Crypt::decrypt($value);

        return '**********';
    }

    public function getSshPasswordAttribute($value)
    {
        if( in_array($_SERVER['REMOTE_ADDR'], Config::get('app.administrator_ip')) )
            return Crypt::decrypt($value);

        return '**********';
    }

    public function setFtpPasswordAttribute($value)
    {
        $this->attributes['ftp_password'] = Crypt::encrypt($value);
    }

    public function setSshPasswordAttribute($value)
    {
        $this->attributes['ssh_password'] = Crypt::encrypt($value);
    }

}
