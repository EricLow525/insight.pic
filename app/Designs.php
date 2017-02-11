<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Designs extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'design_url_id','info_design',
    ];

    public static function getDesignInfo($id){
        return static::find($id);
    }
}
