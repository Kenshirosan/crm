@extends('layouts.app')

@section('content')

<div class="column is-parent is-offset-2 is-4 box">
    <div class="title is-4">{{ __('Login') }}</div>
    <form method="POST" action="{{ route('login') }}" class="tile is-child">
        @csrf
        <div class="field">
            <label class="label is-medium" for="email">{{ __('E-Mail Address') }}</label>
            <p class="control has-icons-left">
                <input
                    class="input is-medium"
                    name="email"
                    type="email"
                    id="email"
                    placeholder="Email"
                    autofocus
                    autocomplete="email"
                />
                <span class="icon is-small is-left">
                    <font-awesome-icon :icon="['fas', 'envelope']" />
                </span>
            </p>
        </div>

        @error('email')
            <span role="alert">
                <strong class="has-text-danger">{{ $message }}</strong>
            </span>
        @enderror

        <div class="field">
            <label class="label is-medium" for="email">{{ __('Password') }}</label>
            <p class="control has-icons-left">
                    <input
                        class="input is-medium @error('password') is-invalid @enderror"
                        name="password"
                        type="password"
                        id="password"
                        placeholder="Password"
                        autocomplete="current-password"
                    />
                    <span class="icon is-small is-left">
                        <font-awesome-icon :icon="['fas', 'user-lock']" />
                    </span>
                </p>
                @error('password')
                    <span role="alert">
                        <strong class="has-text-danger">{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="field">
            <label class="checkbox" for="remember">{{ __('Remember Me') }}</label>
            <input
                type="checkbox"
                name="remember"
                id="remember" {{ old('remember') ? 'checked' : '' }}>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit"
                    class="button is-link">{{ __('Login') }}
                </button>
            </div>
            @if (Route::has('password.request'))
                <div class="control">
                    <a class="button is-link is-light" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>

@endsection
