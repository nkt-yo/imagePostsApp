<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;


class ImagePostController extends Controller
{
    public function index(){

        // ユーザ一覧取得
        $users = $this->getUserList();
        
        // 画像/動画一覧取得
        $contents = Content::findAllContents();
        foreach ($contents as $content) {
            \Debugbar::log($content);
        }

        return view('home', ['users' => $users,'contents' => $contents]);
    }

    public function userDetail($userId){

        // ユーザ一覧取得
        $users = $this->getUserList();

        // ユーザ名取得
        $user = $this->getOneUserName($userId);
        \Debugbar::log($user->name);
        // 画像/動画一覧取取得
        $contents = Content::findOneUserDetail($userId);
        foreach ($contents as $content) {
            \Debugbar::log($content);
        }

        return view('userDetail', ['users' => $users,'user' => $user,'contents' => $contents]);
    }

    /**
     * ユーザ一覧取得
     */
    public function getUserList()
    {
        // ユーザ一覧
        $users = User::findAllUserName();
        foreach ($users as $user) {
            \Debugbar::log($user->name);
        }
        return $users;
    }

    /**
     * 特定のユーザ名取得
     */
    public function getOneUserName($userId)
    {
        // ユーザ名
        $users = User::findOneUsername($userId);
        return $users;
    }
}
