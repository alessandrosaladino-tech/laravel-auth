<div id="app">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">

            <div class="container-fluid">

                <div class="flex-grow-0 col-md-3 col-lg-2 me-0">
                    <a class="navbar-brand" href="/">My Portfolio</a>
                </div>


                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <input class="form-control form-control-dark w-50" type="text" placeholder="Search"
                    aria-label="Search">

                <div class="collapse navbar-collapse justify-content-end flex-grow-0" id="navbarNavDarkDropdown">

                    <ul class="navbar-nav">

                        <li class="nav-item dropdown dropstart">
                            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>

                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>

            </div>

        </nav>

    </header>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">

                            <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                            </a>

                            <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.projects.index' ? 'bg-secondary' : '' }}"
                                href="{{ route('admin.projects.index') }}">
                                <i class="fa-solid fa-diagram-project fa-lg fa-fw"></i> {{ __('Projects') }}
                            </a>

                        </li>

                    </ul>


                </div>
            </nav>