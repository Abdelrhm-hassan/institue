<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admins';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'token',
        'photo',
        'phone',
        'access',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->created_at_sh = jdate('Y-m-d', time());
            $model->created_at_timestamp = time();
        });
    }

}
