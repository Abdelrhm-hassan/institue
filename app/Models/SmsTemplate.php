<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $table = 'sms_template';
    protected $guarded = ['id'];
    public $timestamps = false;
}