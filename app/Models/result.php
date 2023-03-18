<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    protected $table ='result';
    protected $guarded = ['id'];
    protected $fillable = [
        'student_id',
        'doctor_id',
        'subject_id',
        'grade',
        'class_id',
        'status'
    ];
    public function ClassName()
    {
        return $this->belongsTo('App\Models\classRoom','class_id',);
    }
    public function subjectName()
    {
        return $this->belongsTo('App\Models\subject','subject_id');
    }
}