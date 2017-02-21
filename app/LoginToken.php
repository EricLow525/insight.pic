<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use GuzzleHttp\Client as GuzzleClient;
use Mailgun\Mailgun;
class LoginToken extends Model
{
    /**
     * Fillable fields for the model.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'token'];

    /**
     * Generate a new token for the given user.
     *
     * @param  User $user
     * @return $this
     */
    public static function generateFor(User $user)
    {
        $token = static::where('user_id', $user->id)->first();
        if(!$token){
            $token = static::create([
                'user_id' => $user->id,
                'token'   => str_random(50)
            ]);
        }
        return $token;
    }

    /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    /**
     * Send the token to the user.
     */
    public function send()
    {
        $url = url('/auth/token', $this->token);
        Mail::raw(
            "<a href='{$url}'>{$url}</a>",
            function ($message) {
                $message->from('dev@starin.biz')
                        ->to($this->user->email)
                        ->subject('Login to Insight.pic');
            }
        );
    }

    /**
     * A token belongs to a registered user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get userInfo from token in the LoginToken Database.
     * @param  string $insight_token
     * @return LoginToken Object
     */
    public function getTokenUser($insight_token){
        $tokenUser=static::where('token',$insight_token)->first();
        return $tokenUser;
    }
}
