<nav>
    <!-- Settings Dropdown -->
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::check() ? Auth::user()->name : 'Invitado' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                
                <!-- Authentication -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); this.closest('form').submit();">
                           {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Hamburger Menu for Mobile -->
    <button class="btn btn-light d-sm-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Responsive Navigation Menu -->
    <div class="collapse" id="navbarResponsive">
        <ul class="list-group">
            <li class="list-group-item">
                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
        </ul>

        <!-- Responsive Settings Options -->
        <div class="border-top mt-3 pt-3">
            @if (Auth::check())
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <div class="text-muted">{{ Auth::user()->email }}</div>
                </div>
            @else
                <div>
                    <div class="fw-bold">Invitado</div>
                    <div class="text-muted">Sin correo</div>
                </div>
            @endif

            <ul class="list-group mt-3">
                <li class="list-group-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                </li>
                <li class="list-group-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); this.closest('form').submit();">
                           {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
