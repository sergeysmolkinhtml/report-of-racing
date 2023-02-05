<nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container">
        <a href=" {{route('home')}} " class="navbar-brand">
            {{config('app.name')}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a href="{{route('admin')}}" class="nav-link active" aria-current="page">
                        {{__('Admin Panel')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
