<?php

namespace NineCells\Auth\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Socialite;
use NineCells\Auth\Models\SocialLogin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function login()
    {
        return view('ncells::auth.pages.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('auth/login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')
            ->scopes(['user:email'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $guest = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('auth/login');
        }

        $authUser = $this->findOrCreateUser($guest);

        Auth::login($authUser, true);

        return redirect('auth/login');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($guest)
    {
        $ST_GITHUB = 'github';

        $social = SocialLogin::where([
            'social_id' => $guest->id,
            'social_type' => $ST_GITHUB,
        ])->first();

        if ($social) {
            $authUser = $social->user;
            if ($authUser) {
                return $authUser;
            }
        }

        $user = User::where('email', $guest->email)->first();
        if ( !$user ) {
            $user = User::create([
                'name' => $guest->nickname,
                'email' => $guest->email,
            ]);
        }

        SocialLogin::create([
            'user_id' => $user->id,
            'social_id' => $guest->id,
            'social_type' => $ST_GITHUB,
            'avatar' => $guest->avatar,
        ]);

        return $user;
    }
}
