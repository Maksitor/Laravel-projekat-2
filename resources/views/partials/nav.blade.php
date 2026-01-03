<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <div class="logo-icon">CF</div>
            Chocolate Factory
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- JAVNI LINKOVI -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="fas fa-home me-1"></i> Pocetna
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('naruci') ? 'active' : '' }}" href="/naruci">
                        <i class="fas fa-shopping-cart me-1"></i> Naruci proizvod
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sirovine/stanje') ? 'active' : '' }}" href="/sirovine/stanje">
                        <i class="fas fa-chart-bar me-1"></i> Stanje sirovina
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('proizvodni-procesi*') ? 'active' : '' }}" href="/proizvodni-procesi">
                        <i class="fas fa-industry me-1"></i> Proizvodne serije
                    </a>
                </li>

                <!-- ADMIN PANEL (SAMO LOGOVANI) -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('proizvodi*') ? 'active' : '' }}" href="/proizvodi">
                            <i class="fas fa-cog me-1"></i> Admin Panel
                        </a>
                    </li>
                @endauth

                <!-- AUTH SEKCIJA DESNO -->
                @guest
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                            Registracija
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item ms-3 text-white">
                        <small>
                            <i class="fas fa-user me-1"></i>
                            {{ auth()->user()->name }}
                        </small>
                    </li>

                    <li class="nav-item ms-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
