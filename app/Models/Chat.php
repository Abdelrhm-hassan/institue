<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $guarded = ['id'];

    public function sender(){
        return $this->belongsTo('App\Models\student','sender_id');
    }

    public function receiver(){
        return $this->belongsTo('App\Models\student','receiver_id');
    }

    public function messages(){
        return $this->hasMany('App\Models\ChatMessage');
    }


}