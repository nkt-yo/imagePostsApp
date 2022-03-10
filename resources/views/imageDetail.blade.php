<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.side')
@include('layouts.head')
@include('layouts.title')
    <head>
        @yield('head')
    </head>
    <body class="antialiased">
        <div class="container mx-auto my-5 px-5 flex justify-center flex-col">
        @yield('title')
            <!-- ログイン状態・ユーザ一覧・画像一覧 -->
            <div class="contents mx-auto my-5 px-5">
                {{-- サイドコンテンツ呼び出し --}}
                @yield('side')
                {{-- メインコンテンツ --}}
                <div class="main flex flex-col">
                    <div class="text-2xl  mt-6">
                        <a href="{{ url('/user/'. $contents->user_id) }}" class=" text-gray-700 dark:text-gray-500">{{ $contents->name }}</a>
                        > {{ $contents->title }}
                    </div>
                    <div class="post-data flex border">

                        <div class="post-image-detail px-2 py-2">

                            @if ( $contents->type == config('const.contetnsType.movie'))
                                <div class="youtube">
                                    <iframe width="560" height="315"  src="{{'https://www.youtube.com/embed/'. $contents->path }} " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @else
                                <a href="{{ asset('storage/'.$contents->path) }}"  target=”_blank” >
                                    <img src="{{ asset('storage/'.$contents->path) }}" width="100" height="100">
                                </a>
                            @endif
                        </div>
                        <div class="post-data-detail px-2 pt-2">
                            <div class="create-data pb-4">
                                {{-- TODO padding bttom --}}
                                投稿日：{{ $contents->created_at }}
                            </div>
                            <div class="comment">
                                コメント：{{ $contents->comment}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- メインコンテンツ終了 --}}

            </div>
        </div>
    
    </body>
</html>
