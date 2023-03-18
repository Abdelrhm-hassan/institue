<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DocumentMessage extends Model
{
    protected $table = 'document_message';
    protected $guarded = ['id'];
    public $timestamps = false;
}
