<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
connectez-vous
            </div>
        </div>
        <style>
            #searchIcon:hover {
                cursor: pointer;
            }
        </style>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>

                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-5 d-none d-lg-block">
            <a href="http://jasminshop.test" class="text-decoration-none">

                <h1 class="m-0 display-5 font-weight-semi-bold">
                    <img  src="{{ asset("/dashassets/img/team/jasminshop.png") }}" alt="User-Profile-Image" width="150" height="120">
                    <span class="text-primary font-weight-bold boconnectez rder px-3 mr-1">Jasmin</span>Shop</h1>

            </a>
        </div>
        <div class="col-lg-4 col-4 text-left">
            <form id="searchForm" action="/product/search" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher des produits" name="keywords">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary" id="searchIcon">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.getElementById("searchIcon").addEventListener("click", function() {
                document.getElementById("searchForm").submit();
            });
        </script>


<div class="col-lg-5 col-3" style="margin-top: 0px; margin-right: -420px; margin-left:0px;">
    <div class=" text-left">
        @auth
        @if(!empty(auth()->user()->photo))
        <img class="rounded-circle" src="{{ asset('dashassets/img/client/'. auth()->user()->photo) }}" alt="User-Profile-Image" width="60" height="60">
        @else
        <!-- Photo standard -->
        <img class="rounded-circle" src="{{ asset('dashassets/img/client/profile.png') }}" alt="User-Profile-Image" width="60" height="60">
        @endif
            <a href="http://jasminshop.test/client/dashboard" class="btn border">
                <i class="fas fa-user text-primary"></i>
                <span class="badge">
                    {{-- Afficher le nom du client --}}
                    @php
                        $clientName = null; // Initialisation du nom du client à null
                    @endphp

                    @if(is_null($clientName))
                        {{ auth()->user()->name }}
                        @php $clientName = auth()->user()->name; @endphp

                    @endif
                </span>
            </a>
            <a href="http://jasminshop.test/client/cart" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
        @endauth

        @guest
            <a href="http://jasminshop.test/guest/cart1" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
        @endguest

        @auth
            @foreach(auth()->user()->commandes as $commande)
                @php
                    $qtte = 0; // Initialisation de la variable qtte pour stocker la somme des quantités
                @endphp
                @foreach($commande->lignecommandes as $lignec)
                    @if ($commande->etat == "en cours")
                        @php
                            $qtte += $lignec->qte; // Ajouter la quantité de chaque ligne de commande à la somme
                        @endphp
                    @endif
                @endforeach
                @if ($commande->etat == "en cours")
                    <h6 class="d-flex justify-content-around  mb-0 ml-1">{{ $qtte }}</h6>
                @endif
            @endforeach
        @endauth

        </span>
        </a>
    </div>
</div>
</div>
</div>
