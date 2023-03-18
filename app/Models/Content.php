<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }

    public function comments(){
        return $this->hasMany('App\Model\Comment','post_id','id')->where('mode','publish');
    }
}