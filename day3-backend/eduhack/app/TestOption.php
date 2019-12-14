<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{
    protected $fillable = [
        'option', 'value',
    ];
}
