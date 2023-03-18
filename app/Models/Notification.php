<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $guarded = ['id'];

    public function admin(){
        return $this->belongsTo('App\Models\admin');
    }
    public function admins()
    {
        return $this->belongsTo('App\Models\admin','user_id');
    }
    public function doctors()
    {
        return $this->belongsTo('App\Models\doctor','user_id');
    }
    public function students()
    {
        return $this->belongsTo('App\Models\student','user_id');
    }
}