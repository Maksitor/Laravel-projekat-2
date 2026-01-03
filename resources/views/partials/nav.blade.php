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

                <!-- ADMIN PANEL (SAMO ADMIN) -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                                <i class="fas fa-cog me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif
                @endauth

                <!-- GOST LOGIN / REGISTER -->
                @guest
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i> Registracija
                        </a>
                    </li>
                @endguest

                <!-- LOGOVANI KORISNIK -->
                @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-dark"></i>
                            </div>
                            <div class="text-white">
                                <small class="d-block">{{ auth()->user()->name }}</small>
                                <small class="d-block" style="font-size: 0.7rem;">
                                    @if(auth()->user()->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">Korisnik</span>
                                    @endif
                                </small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text">
                                    <small>Ulogovan kao:</small><br>
                                    <strong>{{ auth()->user()->email }}</strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        <i class="fas fa-cog me-2"></i> Admin Panel
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Odjava
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>