<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Content;

use Illuminate\Support\Facades\Storage;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagesList = ['120x120.png', '150x150.png', '180x180.png', '200x200.png', '240x240.png',
                        '300x300.png', '320x340.png', '640x480.png', '800x600.png'];
        $youtubeUrl = "https://www.youtube.com/watch?v=IqKz0SfHaqI";
        // ダミーデータ登録時のみ外部キー制約を無効化する
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        for ($i=0; $i < 30; $i++) { 
            // ユーザテーブルからランダムにユーザ名を取得する
            $user = User::findRandomOneUserid();
            $param = [ 
                'user_id' => $user->id,
                'title' => "title{$i}",
                'type' => 1,
                'comment' => "comment{$i}",
                'path' => $imagesList[array_rand($imagesList)],
            ];
            Content::create($param);
        }

        // ダミーデータ登録終了時に外部キー制約を有効化する
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }

}

