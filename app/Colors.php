<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $fillable = [
        'id', 'color_name','color'
    ];
}
