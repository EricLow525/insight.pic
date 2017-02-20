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
        $userProfile['primary_font']=$profile->primary_font;
        $userProfile['primary_fontsize']=$profile->primary_fontsize;
        $userProfile['secondary_font']=$profile->secondary_font;
        $userProfile['secondary_fontsize']=$profile->secondary_fontsize;
        $userProfile['primary_txtWidth']=$profile->primary_txtWidth;
        $userProfile['secondary_txtWidth']=$profile->secondary_txtWidth;
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
                $primaryTextWidth=$request->primaryTextWidth;
                $primary_fontsize=$request->primaryfontsize;
                $profile->primary_text=$primaryText;
                $profile->primary_txtWidth=$primaryTextWidth;
                $profile->primary_fontsize=$primary_fontsize;
            break;
            case 2:
                $secondaryText=$request->secondaryText;
                $secondaryTextWidth=$request->secondaryTextWidth;
                $secondary_fontsize=$request->secondaryfontsize;
                $profile->secondary_text=$secondaryText;
                $profile->secondary_txtWidth=$secondaryTextWidth;
                $profile->secondary_fontsize=$secondary_fontsize;
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
            case 6:
                $primary_font=$request->primaryfont;
                $profile->primary_font=$primary_font;
            break;
            case 7:
                $primary_fontsize=$request->primaryfontsize;
                $profile->primary_fontsize=$primary_fontsize;
            break;
            case 8:
                $secondary_font=$request->secondaryfont;
                $profile->secondary_font=$secondary_font;
            break;
            case 9:
                $secondary_fontsize=$request->secondaryfontsize;
                $profile->secondary_fontsize=$secondary_fontsize;
            break;
        }
        $profile->save();
        return 'ok';
    }
}
