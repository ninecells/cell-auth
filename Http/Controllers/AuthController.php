<?php

namespace NineCells\Auth\Http\Controllers;

use Log;
use Auth;
use App\User;
use Validator;
use Socialite;
use Exception;
use Illuminate\Http\Request;
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
    public function handleProviderCallback(Request $request)
    {
        $guest = null;
        try {
            $guest = Socialite::driver('github')->user();

            if (!$guest || !isset($guest->user)) {
                throw new Exception('login_status_fail');
            } else if (!isset($guest->user['email'])) {
                throw new Exception('login_status_fail_email');
            } else if (!isset($guest->user['login'])) {
                throw new Exception('login_status_fail_login');
            }
        } catch (Exception $e) {
            $request->session()->flash('login_status', $e->getMessage());
            Log::error($e->getMessage() . ' ' . print_r(get_object_vars($guest), true));
            return redirect('auth/login');
        }

        $authUser = $this->findOrCreateUser($request, $guest);

        Auth::login($authUser, true);

        return redirect("members/{$authUser->id}");
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser(Request $request, $guest)
    {
        $ST_GITHUB = 'github';
        $user = null;

        $social = SocialLogin::where([
            'social_id' => $guest->id,
            'social_type' => $ST_GITHUB,
        ])->first();

        if ($social) {
            $user = $social->user;
            if ($user) {
                goto success;
            }
        }

        $user = User::where('email', $guest->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $guest->user['login'],
                'email' => $guest->user['email'],
            ]);
        }

        SocialLogin::create([
            'user_id' => $user->id,
            'social_id' => $guest->id,
            'social_type' => $ST_GITHUB,
            'avatar' => $guest->avatar,
        ]);

        success:
        $request->session()->flash('login_status', 'login_status_success');

        return $user;
    }
}
