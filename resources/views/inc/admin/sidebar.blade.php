<nav class="navbar navbar-light navbar-vertical navbar-vibrant navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/categories">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span data-feather="cast"></span></span>
                            <span class="nav-link-text">categories</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/products">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span data-feather="cast"></span></span>
                            <span class="nav-link-text">produits</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/clients">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span data-feather="users"></span></span>
                            <span class="nav-link-text">clients</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/commandes">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span data-feather="users"></span></span>
                            <span class="nav-link-text">commandes</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/dashboard">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span data-feather="users"></span></span>
                            <span class="nav-link-text">dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-indicator" href="#pages" role="button" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="pages">
                  <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon d-flex flex-center">
                        <span class="fas fa-caret-right fs-0"></span></div>
                        <span class="nav-link-icon"><span data-feather="layout"></span></span><span class="nav-link-text">suivie</span>
                  </div>
                </a>
                    <ul class="nav collapse parent" id="pages">
                        <li class="nav-item"><a class="nav-link" href="/admin/tabbord/vprod" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-text">les vente par produit</span></div>
                          </a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/tabbord/vmois" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-text">les vente par mois</span></div>
                          </a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/tabbord/chiffre" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-text">chiffre d’affaires</span></div>
                          </a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/tabbord/commandes" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-text">commandes </span></div>
                          </a></li>
                          <li class="nav-item"><a class="nav-link" href="/admin/tabbord/utilisateur" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-text">utilisateurs </span></div>
                          </a></li>
                      </ul>
                </li>
            </ul>



        </div>

        <div class="px-3">

            <div class="navbar-vertical-footer">

                <a class="btn btn-link border-0 fw-semi-bold d-flex ps-0" href="/admin/profile">
                    <span class="navbar-vertical-footer-icon" data-feather="user"></span>
                    <span>changer mot de passe</span>
                </a>

            </div>
            <a  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                class="btn btn-phoenix-secondary d-flex flex-center w-100"
                href="#!"><span class="me-2"
                    data-feather="log-out"></span>Sign out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
<br>
                </div>


    </div>
</nav>
