<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use App\LoginToken;
use App\Designs;
use App\Colors;
class ProfileController extends Controller
{
    public function show(Request $request){
        $userProfile=array();
        $design_url=array();
        $user_id=$request->get('user_id');
        $user=User::findOrFail($user_id);
        $profile=$user->profile()->first();
        $design_id=$profile->design_id;
        $primary_color_id=$profile->primary_color_id;
        $secondary_color_id=$profile->secondary_color_id;

        $designInfo=Designs::getDesignInfo($design_id);

        $size=array("width" => 60, "height" => 50, "crop" => "fill");
        $design_url['id']=$designInfo->id;
        $design_url['url']=cloudinary_url($designInfo->design_url_id,$size);
        $design_url['info']=json_decode($designInfo->info_design,true);
        $priColorInfo=Colors::getColorInfo($primary_color_id);

        $secColorInfo=Colors::getColorInfo($secondary_color_id);

        $userProfile['design_url']=$design_url;
        $userProfile['pricolor']=$priColorInfo;
        $userProfile['seccolor']=$secColorInfo;
        $userProfile['primary_text']=$profile->primary_text;
        $userProfile['secondary_text']=$profile->secondary_text;
        return response()->json($userProfile);
    }

    public function update(Request $request){
        $user_id=$request->get('user_id');
        $user=User::findOrFail($user_id);
        $profile=$user->profile()->first();

        $flag=$request->flag;
        switch($flag){
            case 1:
                $primaryText=$request->primaryText;
                $profile->primary_text=$primaryText;
            break;
            case 2:
                $secondaryText=$request->secondaryText;
                $profile->secondary_text=$secondaryText;
            break;
            case 3:
                $design_id=$request->design_id;
                $profile->design_id=$design_id;
            break;
            case 4:
                $primary_color_id=$request->primary_color_id;
                $profile->primary_color_id=$primary_color_id;
            break;
            case 5:
                $secondary_color_id=$request->secondary_color_id;
                $profile->secondary_color_id=$secondary_color_id;
            break;
        }
        $profile->save();
        return 'ok';
    }
}
