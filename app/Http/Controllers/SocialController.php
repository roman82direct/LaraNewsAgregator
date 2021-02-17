<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteManager;

class SocialController extends Controller
{
    public function login($provider){
        if(\Auth::id()){
            return redirect()->back();
        }
        return Socialite::driver($provider)->redirect();
    }

    public function response(UserRepository $repository, $provider){
        $ownUser = $repository->getBySocialId(
            Socialite::driver($provider)->user(),
            $provider);
//        dd(password_verify('11111111',$ownUser->password));
        \Auth::login($ownUser);
        return redirect()->route('main');
    }
}
