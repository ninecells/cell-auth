<?php

namespace NineCells\Member\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Log;
use NineCells\Member\Models\SocialLogin;
use Response;
use Socialite;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister()
    {
        return view('ncells::member.pages.register');
    }

    public function getLogin()
    {
        return view('ncells::member.pages.login');
    }

    public function logout()
    {
        Auth::logout();
        return Response::json(['redirect' => '/auth/login']);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)
            ->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $guest = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($provider, $guest);
        Auth::login($authUser, true);

        return redirect("members/{$authUser->id}");
    }

    private function findOrCreateUser($provider, $guest)
    {
        $user = null;

        $social = SocialLogin::where([
            'social_id' => $guest->id,
            'social_type' => $provider,
        ])->first();

        if ($social) {
            // 이미 알고있는 사용자
            return $social->user;
        }

        $name = $guest->name;
        $email = $guest->email ?: "{$guest->id}@{$provider}.com";

        $user = User::where('email', $email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
            ]);
        }

        SocialLogin::create([
            'user_id' => $user->id,
            'social_id' => $guest->id,
            'social_type' => $provider,
            'avatar' => $guest->avatar,
        ]);

        return $user;
    }
}
