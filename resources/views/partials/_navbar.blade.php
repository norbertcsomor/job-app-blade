<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        Állásportál
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Kapcsolat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/informations">Információk</a>
                </li>
                @auth
                    <li class="nav-item dropdown justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Üdv, {{ auth()->user()->name }} !
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->role == 'admin')
                                <li>
                                    <a class="dropdown-item" href="/employers">
                                        <i class="bi bi-person-fill"></i>
                                        Munkaadók
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/jobseekers">
                                        <i class="bi bi-person-fill"></i>
                                        Álláskeresők
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/jobadvertisements">
                                        <i class="bi bi-newspaper"></i>
                                        Álláshirdetések
                                    </a>
                                </li>
                            @else
                                @if (auth()->user()->role == 'jobseeker')
                                    <li><a class="dropdown-item" href="/jobseekers/{{ auth()->user()->id }}/edit"><i
                                                class="bi bi-gear-fill"></i>
                                            Szerkesztés</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/jobseekers/jobapplications"><i
                                                class="bi bi-check2"></i>
                                            Jelentkezések</a>
                                    </li>
                                @elseif (auth()->user()->role == 'employer')
                                    <li><a class="dropdown-item" href="/employers/{{ auth()->user()->id }}/edit"><i
                                                class="bi bi-gear-fill"></i>
                                            Szerkesztés</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/employers/jobadvertisements"><i
                                                class="bi bi-newspaper"></i>
                                            Álláshirdetések</a>
                                    </li>
                                @endif
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout"><i class="bi bi-door-closed-fill"></i>
                                    Kijelentkezés</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Munkaadóknak
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/employers/create"> <i class="bi bi-person-plus-fill"></i>
                                    Regisztráció</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/login"><i class="bi bi-door-open-fill"></i>
                                    Bejelentkezés</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Álláskeresőknek
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/jobseekers/create"> <i class="bi bi-person-plus-fill"></i>
                                    Regisztráció</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/login"><i class="bi bi-door-open-fill"></i>
                                    Bejelentkezés</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
