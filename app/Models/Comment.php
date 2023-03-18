<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Model\User','user_id');
    }

    public function contractor(){
        return $this->belongsTo('App\Model\user','contractor_id');
    }

    public function project(){
        return $this->belongsTo('App\Model\Project','project_id');
    }

    public function post(){
        return $this->belongsTo('App\Model\Content','post_id');
    }
}
