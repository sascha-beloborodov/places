<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/21/2016
 * Time: 5:24 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model {

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
