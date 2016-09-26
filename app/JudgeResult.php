<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgeResult extends Model
{
    protected $fillable = [
        'user', 'topicID', 'result', 'time', 'memory'
    ];
}
