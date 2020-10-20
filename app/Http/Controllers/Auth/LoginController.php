<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider() {
        return Socialite::driver('kakao')->redirect();
    }

    public function handleProviderCallback() {
//        dd(Socialite::driver('kakao')->stateless()->user());

        $user = Socialite::driver('kakao')->stateless()->user();

        $existingUser = User::where('kakao_id_number', $user->id)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
//            if (isset($user->email)) {
            $newUser = new User();
            $newUser->name = "kakao";
            $new_email = Str::random(40)."@kakao";
            while (User::where('email', $new_email)->exists()) {
                $new_email = Str::random(40)."@kakao";
            }
            $newUser->email = $new_email;
            $newUser->password = bcrypt(Str::random(40));
            $newUser->kakao_id_number = $user->id;
            $newUser->save();

            auth()->login($newUser, true);
//            }
        }

        return redirect()->to('/home');
    }
}
