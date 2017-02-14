<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Designs;
use App\Colors;
class AuthenticatesUser
{
    use ValidatesRequests;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new AuthenticatesUser instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Send a sign in invitation to the user.
     */
    public function invite()
    {
        $this->validateRequest()
             ->createToken()
             ->send();
    }

    /**
     * Log in the user associated with a token.
     *
     * @param  LoginToken $token
     * @return void
     */
    public function login(LoginToken $token)
    {
        Auth::login($token->user);
    }

    /**
     * Validate the request data.
     *
     * @return $this
     */
    protected function validateRequest()
    {
        $this->validate($this->request, [
            'email' => 'required|email'
        ]);
        return $this;
    }

    /**
     * Prepare a log in token for the user.
     *
     * @return LoginToken
     */
    protected function createToken()
    {
        $user = User::byEmail($this->request->email);
        if(!$user){
            $discovery = $this->request->checkVal;
            $user=User::create(['email'=>$this->request->email,
                                'discovery'=>$discovery
                                ]);
            $user_id=$user->id;
            $design_id=Designs::orderBy('id', 'asc')->take(1)->first()->id;
            $colors = Colors::orderBy('id', 'asc')->take(2)->get();
            $primary_color_id = $colors[0]->id;
            $secondary_color_id = $colors[1]->id;
            Profile::create(['user_id'=>$user_id,
                             'design_id'=>$design_id,
                             'primary_color_id'=>$primary_color_id,
                             'secondary_color_id'=>$secondary_color_id
                            ]);
        }
        return LoginToken::generateFor($user);
    }
}
