<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    protected $table='doctors';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'bio',
        'code',
        'password',
        'photo',
        'phone',
        'gender',
        'status',
        'linkedin',
        'token',
        'type',
    ];
}