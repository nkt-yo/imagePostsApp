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
                        {{$user->name}}
                    </div>

                    <div class="image-list p-3 rounded w-full px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg sm:max-w-3xl"　>
                        <div class="grid grid-cols-3 gap-6">
                            @foreach ($contents as $content)
                            <div class="post-data px-2 pt-2 flex-col border">
                                <div class="post-image">
                                    @if ( $content->type == config('const.contetnsType.movie'))
                                        <div class="youtube">
                                            <iframe src="{{'https://www.youtube.com/embed/'. $content->path }} " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        <a href="{{ url('/image/' . $content->content_id) }}">
                                            <img src="{{ asset('storage/'.$content->path) }}" width="100" height="100">
                                        </a>
                                    @endif
                                    <p><a href="{{ url('/image/' . $content->content_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $content->title }}</a></p>
                                    <a href="{{ url('/user/'. $content->user_id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $content->name }}</a>
                                </div>
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
