@extends('layouts.app')

@section('content')
<div class="box">
    <div class="title is-4">{{ __('Register') }}</div>
    <form method="POST" action="{{ route('register') }}" class="tile is-child">
        @csrf
        <div class="field">
            <label for="name" class="label is-medium">{{ __('Name') }}</label>
            <p class="control has-icons-left">
                <input
                    id="name"
                    type="text"
                    class="input is-medium @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required autocomplete="name" autofocus>
                    <span class="icon is-small is-left">
                        <font-awesome-icon :icon="['fas', 'user']" />
                    </span>
                    @error('name')
                        <span role="alert">
                            <strong class="has-text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
            </p>
        </div>

        <div class="field">
            <label for="email" class="label is-medium">{{ __('E-Mail Address') }}</label>
            <p class="control has-icons-left">
                <input
                    id="email"
                    type="email"
                    class="input is-medium @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email">
                <span class="icon is-small is-left">
                    <font-awesome-icon :icon="['fas', 'envelope']" />
                </span>
                @error('email')
                    <span role="alert">
                        <strong class="has-text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </p>
        </div>

        <div class="field">
            <label for="password" class="label is-medium">{{ __('Password') }}</label>
            <p class="control has-icons-left">
                <input
                    id="password"
                    type="password"
                    class="input is-medium @error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="new-password">
                <span class="icon is-small is-left">
                    <font-awesome-icon :icon="['fas', 'user-lock']" />
                </span>
                @error('password')
                    <span role="alert">
                        <strong class="has-text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </p>
        </div>

        <div class="field">
            <label for="password-confirm" class="label is-medium">{{ __('Confirm Password') }}</label>
            <p class="control has-icons-left">
                <input
                    id="password-confirm"
                    type="password"
                    class="input is-medium"
                    name="password_confirmation"
                    required autocomplete="new-password">
                <span class="icon is-small is-left">
                    <font-awesome-icon :icon="['fas', 'user-lock']" />
                </span>
            </p>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
