<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $table ='subjects';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'price',
        'hours',
        'class_id',
    ];
    public function ClassName()
    {
        return $this->belongsTo('App\Models\classRoom','class_id',);
    }
}