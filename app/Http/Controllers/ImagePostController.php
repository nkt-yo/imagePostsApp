<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;


class ImagePostController extends Controller
{   
    /**
     * トップページ
     */
    public function index(){

        // ユーザ一覧取得
        $users = $this->getUserList();
        
        // 画像/動画一覧取得
        $contents = Content::findAllContents();

        return view('home', ['users' => $users,'contents' => $contents]);
    }

    /**
     * ユーザページ
     */
    public function userDetail($userId){


        // ユーザ一覧取得
        $users = $this->getUserList();
        \Debugbar::log($users);

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
     * 画像ページ
     */
    public function imageDetail($contentId){
        // ユーザ一覧取得
        $users = $this->getUserList();

        // 画像/動画情報取得
        $contents = Content::findOneImageDetail($contentId);
        \Debugbar::log($contents);

        return view('imageDetail', ['users' => $users, 'contents' => $contents]);
    }

    /**
     *  画像アップロードページ
     */
    public function uploadImageIndex(){
        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();
        return view('uploadImage', ['users' => $users, 'authUser' => $authUser]);
    }

    /**
     *  画像アップロード
     */
    public function uploadImage(Request $request){

        // バリデーションチェック
        $this->validationUplaodImage($request);
        
        // ログイン中のユーザ情報取得
        $authUser = $this->getAuthUser();
        $imageUrl = $request['url'];
        $title = $request['title'];
        $comment = $request['comment'];
        $type = config('const.contetnsType.image');

        try {
            $imgData = file_get_contents($imageUrl);
            \Debugbar::log($imgData);

            $pos = strpos($http_response_header[0], '200');
            if (!$pos) {
                // ファイルを取得できなかった場合
            }else{
                $imageSize = getimagesize('data:application/octet-stream;base64,' . base64_encode($imgData));
                \Debugbar::log($imageSize);
                
                // 画像タイプによって拡張子を決める
                if ($imageSize['mime'] == "image/jpeg") {
                    $extension = ".jpg";
                }elseif ($imageSize['mime'] == "image/png") {
                    $extension = ".png";
                }else{
                    \Debugbar::log("画像取得失敗");
                    return redirect('/uploadImage')->withErrors('画像取得に失敗しました。');
                }

                $path = 'images/' . uniqid() . $extension;
                // 画像の保存
                Storage::put('public/' . $path , $imgData);
                
                // コンテンツテーブルに登録
                Content::insertOne($authUser['id'], $title, $type, $comment, $path);
            }
        } catch (\Exception $e) {
            \Debugbar::log("画像取得失敗");
            return redirect('/uploadImage')->withErrors('画像取得に失敗しました。');
        }

        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();
        return view('uploadImage', ['users' => $users, 'authUser' => $authUser]);
    }

    /**
     * 画像投稿ページ
     */
    public function postImageIndex(){
        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();
        return view('postImage', ['users' => $users, 'authUser' => $authUser]);
    }
    
    /**
     * 画像投稿
     */
    public function postImage(Request $request){

        // バリデーションチェック
        $this->validationPostImage($request);

        // ログイン中のユーザ情報取得
        $authUser = $this->getAuthUser();
        $title = $request['title'];
        $comment = $request['comment'];
        $type = config('const.contetnsType.image');
        // 最大画像サイズは10MB
        $request->validate([
			'image' => 'required|file|image|max:10240|mimes:png,jpeg'
		]);

        try {
            $uploadImage = $request->file('image');

            if($uploadImage) {
                $path = $uploadImage->store('images',"public");
                if($path){
                    // 画像に保存成功後、コンテンツテーブルに追加する
                    Content::insertOne($authUser['id'], $title, $type, $comment, $path);
                    \Debugbar::log($path);
                }
            }
        } catch (\Exception $e) {
            \Debugbar::log("画像取得失敗");
            // エラーメッセージを設定
            return redirect('/postImage')->withErrors('画像取得に失敗しました。');
        }

        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();

        return view('postImage', ['users' => $users, 'authUser' => $authUser]);
    }


    /**
     * 動画投稿ページ
     */
    public function postMovieIndex(){
        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();
        return view('postMovie', ['users' => $users, 'authUser' => $authUser]);
    }

    /**
     * 動画投稿
     */
    public function postMovie(Request $request){

        // バリデーションチェック
        $this->validationUplaodImage($request);

        // ログイン中のユーザ情報取得
        $authUser = $this->getAuthUser();
        $title = $request['title'];
        $url = $request['url'];
        $comment = $request['comment'];
        $type = config('const.contetnsType.movie');


        // 動画IDのみ取得する
        $youtubeId = $this->getYoutubeId($url);
        if ($youtubeId === false) {
            \DebugBar::log("動画の取得に失敗しました。");
            return redirect('/postMovie')->withErrors('動画取得に失敗しました。');
        }else{
            \DebugBar::log($youtubeId);
            \DebugBar::log("動画取得成功");
            Content::insertOne($authUser['id'], $title, $type, $comment, $youtubeId);
        }

        // コンテンツ情報追加のメソッドを追加する
        // ユーザ一覧取得
        $users = $this->getUserList();
        $authUser = $this->getAuthUser();
        return view('postMovie', ['users' => $users, 'authUser' => $authUser]);
    }

    /**
     * ユーザ一覧取得
     */
    public function getUserList()
    {
        // ユーザ一覧
        $users = User::findAllUserName();
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

    /**
     * ログイン中のユーザ情報を取得
     */
    public function getAuthUser()
    {
        // 現在認証しているユーザーを取得
        $authUser = Auth::user();
        \Debugbar::log($authUser);

        // 現在認証しているユーザーのIDを取得
        return  ['id' => $authUser->id, 'name' => $authUser->name];
    }

    /**
     * youtubeの動画IDを返す
     */
    public function getYoutubeId($url){

        // 通常URL、短縮URL、埋め込みURLに対応
        $prex = "/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i";
        // 動画IDを取得する
        if(preg_match($prex, $url, $results)){
            return $results[6];
        }else{
            return false;
        }
    }

    /**
     * 画像/動画投稿ページ用バリデーション
     */
    public function validationUplaodImage(Request $request){

        $request->validate([
            'title' => 'required|max:30',
            'comment' => 'required|max:150',
            'url' => 'required',
        ]);
    }

    /**
     * 画像アップロードページ用バリデーション
     */
    public function validationPostImage(Request $request){

        $request->validate([
            'title' => 'required|max:30',
            'comment' => 'required|max:150',
            'image' => 'required',
        ]);
    }
}
