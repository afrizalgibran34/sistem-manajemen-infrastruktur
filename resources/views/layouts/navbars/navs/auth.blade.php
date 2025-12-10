@php
    $activePage = $activePage ?? '';
    $navName = $navName ?? '';
@endphp

<nav class="navbar navbar-expand-lg" color-on-scroll="500">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            {{ $navName }}
        </a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav d-flex align-items-center">

                {{-- Dropdown User --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        Selamat datang, <strong>{{ Auth::user()->name }}</strong>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                        {{-- Profile --}}
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        {{-- Logout --}}
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                Logout
                            </button>
                        </form>

                    </div>
                </li>

            </ul>
        </div>

    </div>
</nav>
