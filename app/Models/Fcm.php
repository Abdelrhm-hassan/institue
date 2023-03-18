<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fcm extends Model
{
    protected $table = 'fcm';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
