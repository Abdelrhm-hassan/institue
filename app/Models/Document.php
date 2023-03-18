<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Model\User','user_id');
    }

    public function project(){
        return $this->belongsTo('App\Model\Project','project_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->created_at_sh = jdate('Y-m-d', time());
            $model->created_at_timestamp = time();
        });
    }
}
