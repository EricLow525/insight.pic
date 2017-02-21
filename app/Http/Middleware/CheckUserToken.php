<?php

namespace App\Http\Middleware;

use Closure;
use App\LoginToken;
class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * Sends a token as a header to the back-end from the front-end and get the userInfo using token
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tokenUser=app(LoginToken::class)->getTokenUser($request->header('insight-auth-token'));
        if(!$tokenUser){
            throw new \Exception('Problem with your account or no valid token.',401);
        }
        $request->attributes->add(array('user_id'=>$tokenUser->user_id));
        return $next($request);
    }
}
