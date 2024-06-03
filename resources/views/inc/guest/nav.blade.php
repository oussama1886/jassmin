<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <!-- Sidebar -->
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <!-- Brand -->
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop</h1>
                    <img class="rounded-circle" src="{{ asset("/dashassets/img/team/admin.jpeg") }}" alt="User-Profile-Image" width="60" height="60">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <!-- Navigation links -->
                    </div>
                    <!-- Bouton "Sign out" -->
                    <div class="col-lg-5 col-3" style="margin-top: -234px;">
                        <div class="text-right">
                            @auth
                            <!-- Si l'utilisateur est connecté -->
                            <button class="btn border">
                                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class='fas fa-sign-out-alt' style='color:#f38d39'></i>
                                </a>
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @else
                            <!-- Si l'utilisateur n'est pas connecté -->
                            <div class="d-flex justify-content-end">
                                <a href="/login" class="btn border nav-item nav-link" style="margin-right: 10px;">Connexion</a>
                                <a href="/register" class="btn border nav-item nav-link">Créer un compte</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Header -->
            <!-- ... -->
        </div>
    </div>
</div>
