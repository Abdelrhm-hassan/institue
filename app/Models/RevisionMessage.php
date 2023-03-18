<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RevisionMessage extends Model
{
    protected $table = 'revision_message';
    protected $guarded = ['id'];

    public function revision(){
        return $this->belongsTo('App\Model\Revision','revision_id');
    }

    public function user(){
        return $this->belongsTo('App\Model\User','user_id');
    }


}
