<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatReport extends Model
{
    protected $table = 'chat_report';
    protected $guarded = ['id'];

    public function reporter(){
        return $this->belongsTo('App\Model\User','reporter_id');
    }

    public function chat(){
        return $this->belongsTo('App\Model\Chat','chat_id');
    }
}