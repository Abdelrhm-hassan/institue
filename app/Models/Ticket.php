<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }

    public function parent(){
        return $this->belongsTo('App\Model\Ticket','parent_id');
    }

    public function messages(){
        return $this->hasMany('App\Model\Ticket','parent_id');
    }

    public function user(){
        return $this->belongsTo('App\Model\User','user_id');
    }
}
