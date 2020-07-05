<header>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://marseillecrm.fr">
                <span class="title is-4 has-text-centered-desktop has-text-success">Marseille Web CRM</span>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">
                    Home
                </a>

                <a class="navbar-item" href="/clients">
                    Clients
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        More
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="/about">
                            About
                        </a>
                        <a class="navbar-item" href="/contact">
                            Contact
                        </a>
                        <a class="navbar-item" href="/debug">
                            Report an issue
                        </a>
                        <hr class="navbar-divider">
                        @auth
                            <a class="navbar-item" href="/users/{{ Auth::user()->email }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
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
    </nav>
</header>
<section class="hero is-primary mt-20 mb-20">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Primary title
            </h1>
            <h2 class="subtitle">
                Primary subtitle
            </h2>
        </div>
    </div>
</section>
