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
                        ->subject('Login to Laracasts');
            }
        );
/*
        $client = new GuzzleClient([
            'verify' => false,
        ]);
        $adapter = new GuzzleAdapter($client);
        $mg = new Mailgun("key-49b5c4bddda055041a34830181aec2dbe",$adapter);
        $domain = "sandboxb89c04fc984b4e299760ff91a91c58e7.mailgun.org";
//        $mg->setSslEnabled(false);
        # Now, compose and send your message.
        $mg->sendMessage($domain, array('from'    => 'bob@example.com',
                                        'to'      => 'happinesseric525@gmail.com',
                                        'subject' => 'The PHP SDK is awesome!',
                                        'text'    => 'It is so simple to send a message.'));
                                        */
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
}
