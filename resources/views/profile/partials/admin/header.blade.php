<header id="app_header" class="py-2 bg-dark">
    <nav class="nav justify-content-around ">
        <div class="main-link d-flex justify-content-center">
            {{-- <a class="nav-link active" href="{{ route('home') }}">Home</a> --}}
            <a class="nav-link" href="{{ route('index') }}">Projects</a>
            <a class="nav-link" href="{{ route('create') }}">Add Project</a>
        </div>
        <div class="link"><a class="nav-link" href="{{ route('home') }}">Guest</a></div>
    </nav>
</header>