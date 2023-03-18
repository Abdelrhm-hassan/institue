<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acadmic_year extends Model
{
    protected $table = 'acadmic-years';
    protected $guarded = ['id'];
    protected $fillable = ['name'];

    
    use HasFactory;
}
