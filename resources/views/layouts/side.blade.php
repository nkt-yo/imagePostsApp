@section('side')
{{-- サイドコンテンツ --}}
<div class="side px-3">
    
    {{-- ログイン状態 --}}
    <div class="bg-orange-500 rounded">
        
    @if (Route::has('login'))
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg">
            @auth
                <div class="user-name">
                    <a href="{{ url('/user/'. Auth::user()->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ Auth::user()->name }}さん</a>
                </div>
                <div class="menu flex flex-col items-center	">
                    
                    <a href="{{ url('/uploadImage/') }}" class="">
                        <button class="w-48 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            画像をアップロード
                        </button>
                    </a>
                    <a href="{{ url('/postImage/') }}" class="">
                        <button class="w-48 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            画像を投稿
                        </button>
                    </a>
                    <a href="{{ url('/postMovie/') }}" class="">
                        <button class="w-48 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            動画を投稿
                        </button>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ url('/postMovie/') }}" class="">
                            <button type="submit" class="w-48 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                ログアウト
                            </button>
                        </a>
                    </form>
                </div>

            @else
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('ログイン情報を保持する') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Sign in') }}
                    </x-jet-button>
                </div>
            </form>

            @if (Route::has('register'))
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Sign up</a>
            </div>
            @endif
            @endauth
        </div>
    @endif
    </div>
    {{-- ログイン状態終了 --}}

    {{-- ユーザ一覧 --}}
    <div class="user-list w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg truncate">
        <h2>ユーザー</h2>
        @foreach ($users as $user)
            <p><a href="{{ url('/user/'.$user->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ $user->name }}</a></p>
        @endforeach
        {{ $users->links() }}

    </div>
    {{-- ユーザ終了 --}}

</div>
{{-- サイドコンテンツ終了 --}}
@endsection
