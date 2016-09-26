<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddSubject extends Model
{
    protected $fillable = [
        'topic', 'detail', 'input', 'output', 'deadline'
    ];
}
