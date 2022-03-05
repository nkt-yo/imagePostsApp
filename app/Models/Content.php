<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request;
class Content extends Model
{
    protected $table = 'contents';
    protected $primaryKey = 'id';
    
    public static function findAllContents()
    {
        // コンテンツID, ユーザID, ユーザ名, 画像/動画タイトル, コンテンツタイプ, 画像/動画パス, 作成日時
        $contents = Content::leftjoin('users', 'users.id', '=', 'contents.user_id')
                        ->select('contents.id as content_id', 'users.id as user_id', 'users.name', 'contents.title',
                                    'contents.type', 'contents.path', 'contents.created_at')
                        ->orderBy('contents.created_at')
                        ->paginate(12, ["*"], 'contentpage')
                        ->appends(["userpage" => \Request::get('userpage')]);
        return $contents;
    }

    public static function findOneUserDetail($userid)
    {
        // コンテンツID, ユーザ名, 画像/動画タイトル, コンテンツタイプ, 画像/動画パス, 作成日時
        $contents =  Content::leftjoin('users', 'users.id', '=', 'contents.user_id')
                        ->select('contents.id as content_id', 'users.id as user_id', 'users.name', 'contents.title', 
                                    'contents.type', 'contents.path', 'contents.created_at')
                        ->where('users.id', $userid)
                        ->orderBy('contents.created_at')
                        ->paginate(12);
        return $contents;
    }


    public static function findOneImageDetail($contentId)
    {
        // コンテンツID, ユーザ名, 画像/動画タイトル, コンテンツタイプ, 画像/動画パス, 作成日時, コメント
        $contents =  Content::leftjoin('users', 'users.id', '=', 'contents.user_id')
                        ->select('contents.id as content_id', 'users.id as user_id', 'users.name', 'contents.title',
                                    'contents.type', 'contents.path', 'contents.created_at', 'contents.comment')
                        ->where('contents.id', $contentId)
                        ->first();
        return $contents;
    }

}
