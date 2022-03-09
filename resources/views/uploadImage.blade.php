<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.side')
@include('layouts.head')
    <head>
        @yield('head')
    </head>
    <body class="antialiased">
        <div class="container mx-auto my-5 px-5 flex justify-center">
            
            <!-- ログイン状態・ユーザ一覧・画像一覧 -->
            <div class="contents">
                {{-- サイドコンテンツ呼び出し --}}
                @yield('side')
                {{-- メインコンテンツ --}}
                <div class="main">
                  <div class="flex border w-full mt-6 px-6 py-4 shadow-md sm:rounded-lg">
                    <form action="/uploadImage" method="POST" class="w-full max-w-lg">
                      @csrf
          
                      <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                          <label class="block tracking-wide mb-2" for="">
                          タイトル
                          </label>
                          <input class=""id="title" name="title" type="text" size="40">

                          <label class="block tracking-wide mb-2" for="">
                          コメント
                          </label>
                          <textarea name="comment" cols="40" rows="3"></textarea>
                          
                          <label class="block tracking-wide mb-2" for="">
                          画像URL
                          </label>
                          <textarea name="image-url" cols="40" rows="3"></textarea>
                          <button type="submit" class="flex bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                          投稿
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                {{-- メインコンテンツ終了 --}}

            </div>
        </div>
    
    </body>
</html>
