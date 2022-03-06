<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.side')
@include('layouts.head')
    <head>
        @yield('head')
    </head>
    <body class="antialiased">
        <div class="mx-auto my-5 px-5 flex justify-center">
            <!-- ログイン状態・ユーザ一覧・画像一覧 -->
            <div class="contents">
                {{-- サイドコンテンツ呼び出し --}}
                @yield('side')
                {{-- メインコンテンツ --}}
                <div class="main">
                    <div class="p-3 rounded w-full mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg sm:max-w-3xl"　>
                        <h2>画像一覧</h2>
                        <div class="image-list grid grid-cols-3 gap-4">
                            @foreach ($contents as $content)
                            <div class="post-data px-2 pt-2 flex-col border">

                                <div class="post-image">
                                    <a href="{{ url('/image/' . $content->content_id) }}">
                                        <img src="{{ asset('storage/images/'.$content->path) }}" width="100" height="100">
                                    </a>
                                </div>

                                <p><a href="{{ url('/image/' . $content->content_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $content->title }}</a></p>
                                <p><a href="{{ url('/user/' . $content->user_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $content->name }}</a></p>
                            </div>
                            @endforeach
                            {{ $contents->links() }}
                        </div>
                    </div>
                </div>
                {{-- メインコンテンツ終了 --}}

            </div>
        </div>
    
    </body>
</html>
