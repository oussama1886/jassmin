<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
            aria-controls="navbarVerticalCollapse" aria-expanded="false"
            aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3"
            href="/admin/dashboard">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center"><img
                        src="{{ asset('dashassets/img/icons/logo.png') }}" alt="phoenix" width="32">
                    <p class="logo-text ms-2 d-none d-sm-block">Jasmin Shop</p>
                </div>
            </div>
        </a></div>
    <div class="collapse navbar-collapse">

        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">



            <li class="nav-item dropdown">
<h4>Administrateur</h4>
             <img class="rounded-circle" src="{{ asset("/dashassets/img/team/admin.jpeg") }}" alt="User-Profile-Image" width="60" height="60">


                <div class="dropdown-menu dropdown-menu-end py-0 dropdown-profile shadow border border-300"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card bg-white position-relative border-0">
                        <div class="card-body p-0 overflow-auto scrollbar" style="height: 18rem;">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="assets/img/team/57.png" alt="">
                                </div>
                                <h6 class="mt-2">{{ auth()->user()->name }} </h6>
                            </div>






                        </div>
                        <div class="card-footer p-0 border-top">




                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
