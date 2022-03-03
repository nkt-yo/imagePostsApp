<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;


class ImagePostController extends Controller
{
    public function index(){

        // ユーザ一覧
        $users = User::findAllUserName();
        foreach ($users as $user) {
            \Debugbar::log($user->name);
        }
        
        // 画像/動画一覧
        $contents = Content::findAllContents();
        foreach ($contents as $content) {
            \Debugbar::log($content);
        }

        return view('home', ['users' => $users,'contents' => $contents]);
    }
}
