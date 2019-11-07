<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\User'); // belongsTo() method is only one row.
    }

    public function orderitem(){
        return $this->hasMany('App\Orderitem'); //hasMany() method is more than one row.
    }
}
