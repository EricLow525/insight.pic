<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $fillable = [
        'id', 'color_name','color','alpha'
    ];

    public static function getColorInfo($id){
        return static::find($id);
    }
}
