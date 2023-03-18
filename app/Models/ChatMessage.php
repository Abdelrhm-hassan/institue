<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_message';
    protected $guarded = ['id'];

    public function chat(){
        return $this->belongsTo('App\Models\Chat','chat_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','sender_id');
    }
}