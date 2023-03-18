<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classRoom extends Model
{
    protected $table = 'class_rooms';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'price',
        'hours',
        'year_id',
        'class_id',
        'level'
    ];
    public function year()
    {
        return $this->belongsTo('App\Models\acadmic_year');
    }
    
}