<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('home') }}" class="logo logo-normal">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Orange Mali RH">
        </a>
        <a href="{{ route('home') }}" class="logo-small">
            <img src="{{ asset('assets/img/logo-small.svg') }}" alt="Orange Mali RH">
        </a>
        <a href="{{ route('home') }}" class="dark-logo">
            <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Orange Mali RH">
        </a>
    </div>
    <!-- /Logo -->
    <div class="modern-profile p-3 pb-0">
        <div class="text-center rounded bg-light p-3 mb-4 user-profile">
            <div class="avatar avatar-lg online mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="Img"
                    class="img-fluid rounded-circle">
            </div>
            <h6 class="fs-12 fw-normal mb-1">{{ Auth::user()->name }}</h6>
            <p class="fs-10">{{ Auth::user()->isAdmin() ? 'Administrateur RH' : 'Espace Employé' }}</p>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>MENU RH</span></li>
                <li>
                    <a href="{{ route('home') }}">
                        <i class="ti ti-smart-home"></i><span>Tableau de bord</span>
                    </a>
                </li>

                @if(Auth::user()->isAdmin())
                    {{-- MENU ADMIN --}}
                    <li>
                        <a href="{{ route('employees.index') }}">
                            <i class="ti ti-users"></i><span>Employés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('leaves.index') }}">
                            <i class="ti ti-calendar-event"></i><span>Gestion Congés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendances.index') }}">
                            <i class="ti ti-clock"></i><span>Registre Pointage</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contracts.index') }}">
                            <i class="ti ti-file-text"></i><span>Contrats</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}"><i class="ti ti-building"></i><span>Départements</span></a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="ti ti-user"></i><span>Utilisateurs</span>
                        </a>
                    </li>
                @else
                    {{-- MENU EMPLOYE --}}
                    <li>
                        <a href="{{ route('leaves.index') }}">
                            <i class="ti ti-calendar-event"></i><span>Mes Congés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('leaves.create') }}">
                            <i class="ti ti-calendar-plus"></i><span>Nouvelle Demande</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendances.kiosk') }}" target="_blank">
                            <i class="ti ti-device-display"></i><span>Faire mon Pointage</span>
                        </a>
                    </li>
                @endif

                <li class="menu-title"><span>COMPTE</span></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="ti ti-logout"></i><span>Déconnexion</span>
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
