<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Colors;
use App\Designs;
class Profile extends Model
{
    protected $fillable = [
        'user_id','primary_text','secondary_text','design_id','primary_color_id','secondary_color_id',
    ];
}
