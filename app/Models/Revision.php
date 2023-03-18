<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revision';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function project(){
        return $this->belongsTo('App\Model\Project','project_id');
    }

    public function messages(){
        return $this->hasMany('App\Model\RevisionMessage','revision_id');
    }

    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }
}
