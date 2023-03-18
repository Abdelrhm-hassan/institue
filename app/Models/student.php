<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table='students';   
     protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'code',
        'password',
        'photo',
        'grade',
        'phone',
        'email',
        'gender',
        'status',
        'class_id',
        'token',
        'type',
        'linkedin',
        'bio'
    ];

    public function className()
    {
        return $this->belongsTo('App\Models\classRoom','class_id');
    }
}