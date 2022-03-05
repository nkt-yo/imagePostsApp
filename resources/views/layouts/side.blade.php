@section('side')
{{-- サイドコンテンツ --}}
<div class="side p-3">
    {{-- ログイン状態 --}}
    <div class="bg-orange-500 rounded">
    @if (Route::has('login'))
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg">
            <h2>Sign in</h2>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン中のユーザ</a>
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

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-jet-button class="ml-4">
                        {{ __('Sign in') }}
                    </x-jet-button>
                </div>
            </form>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Sign up</a>
            @endif
            @endauth
        </div>
    @endif
    </div>
    {{-- ログイン状態終了 --}}

    {{-- ユーザ一覧 --}}
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-600 shadow-md sm:rounded-lg">
        <h2>ユーザー</h2>
        @foreach ($users as $user)
            <li class="list-group-item">
            {{ $user->name }}
            </li>
        @endforeach
        {{ $users->links() }}

    </div>
    {{-- ユーザ終了 --}}

</div>
{{-- サイドコンテンツ終了 --}}
@endsection