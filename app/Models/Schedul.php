<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedul extends Model
{
    protected $table ='scheduls';
    protected $guarded = ['id'];
    protected $fillable = [
        'student_id',
        'doctor_id',
        'sub_id',
        'class_id',
        'grade',
        'status'
    ];

}
