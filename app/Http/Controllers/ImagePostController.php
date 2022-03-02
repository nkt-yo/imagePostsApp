<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ImagePostController extends Controller
{
    public function index(){

        $users =User::findAllUserName();
        print($users);
        \Debugbar::log($users);
        foreach ($users as $user) {
            \Debugbar::log($user->name);
        }



        return view('home', ['users' => $users]);
    }
}
