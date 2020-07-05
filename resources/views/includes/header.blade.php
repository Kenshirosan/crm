<header class="mb-5-percent">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img
                    alt="Vue logo"
                    src="./img/logo.png"
                    width="30"
                    height="30"
                    class="d-inline-block align-top"
                    loading="lazy"
                />
                    Carnet d'addresses
            </a>
            @if (Route::has('login'))
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a class="button is-light" href="{{ route('login') }}">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="button is-primary">
                                    <strong>Sign up</strong>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endif
        </div>
    </nav>
</header>
