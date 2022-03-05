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
                    <div class="image-list p-3 rounded w-full mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg sm:max-w-3xl"　>
                        <p><a href="{{ url('/user/'. $contents->user_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $contents->name }}</a>
                        >{{ $contents->name }}
                        </p>

                        <img src="{{ asset('storage/images/'.$contents->path) }}" class= "post-image" width="100" height="100">
                        <div class="create-data">
                            投稿日：{{ $contents->created_at }}
                        </div>
                        <div class="comment">
                            {{ $contents->comments}}
                        </div>
                    </div>
                </div>
                {{-- メインコンテンツ終了 --}}

            </div>
        </div>
    
    </body>
</html>
