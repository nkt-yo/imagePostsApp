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
                    <p><a href="{{ url('/user/'. $contents->user_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $contents->name }}</a>
                        >{{ $contents->title }}
                    </p>
                    <div class="border">
                        <div class="post-data flex border">

                            <div class="post-image px-2 pt-2">
                                <a href="{{ url('/image/' . $contents->content_id) }}">
                                    <img src="{{ asset('storage/images/'.$contents->path) }}" width="100" height="100">
                                </a>
                            </div>
                            <div class="post-data-detail px-2 pt-2">
                                <div class="create-data pb-6">
                                    投稿日：{{ $contents->created_at }}
                                </div>
                                <div class="comment">
                                    コメント{{ $contents->comment}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- メインコンテンツ終了 --}}

            </div>
        </div>
    
    </body>
</html>
