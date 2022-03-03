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
        // 画像タイトル、ユーザID、動画パス、タイプ
        $contents = Content::leftjoin('users', 'users.id', '=', 'contents.user_id')
                        ->select('contents.id', 'users.name', 'contents.title', 'contents.type', 'contents.path', 'contents.created_at')
                        ->orderBy('contents.created_at')
                        ->paginate(12, ["*"], 'contentpage')
                        ->appends(["userpage" => \Request::get('userpage')]);
        return $contents;
    }
}
