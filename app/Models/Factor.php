<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    protected $table = 'factor';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
    public function project(){
        return $this->belongsTo('App\Model\Project');
    }
}
