<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'user', 'name', 'topicID', 'language', 'result'
    ];
}
