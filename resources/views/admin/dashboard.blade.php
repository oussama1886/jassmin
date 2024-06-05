<!doctype html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jasmin Shop</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset ('dashassets/css/phoenix.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset ('dashassets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<style>
    body {
        opacity: 0;
    }
</style>

<main class="main" id="top">
    <div class="container-fluid px-0">

        @include('inc.admin.sidebar')


        @include('inc.admin.nav')


        <div class="container">

            <div class="row justify-content-center" style="margin-left:180px; margin-top: 20px;">
                <h1>Tableau de bord</h1>

                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                     @if ($lowStockCount > 0)
                    <div class="card text-white bg-warning">
                        <div class="card-header"><i class="fa fa-user-plus"></i> stockage
                        </div>
                        <div class="card-body">

                            <!-- Conteneur de l'icône du panier avec le même arrière-plan -->
                            <div class="card text-white bg-secondary" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa fa-bell-o' style="font-size: 100px; color: #ff0000; opacity: 100%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%;
                                    width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>

                            <h4 class="card-title" style="margin-right:150px;"><div>

                                <h4>nombre de produit dont quantite stockage inferieur a 20  : {{  $lowStockCount }}</h4>
                               @else
                               <div class="card text-white bg-success">
                                <div class="card-header"><i class="fa fa-user-plus"></i> commandes
                                </div>
                                <div class="card-body">
                                <!-- Conteneur de l'icône du panier avec le même arrière-plan -->
                            <div class="card text-white bg-primary" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa fa-shopping-cart' style="font-size: 100px; color: #eed67e; opacity: 100%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%;
                                    width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>

                            <h4 class="card-title" style="margin-right:150px;"><div>
                               <h4>pas de quantite de stockage de produit inferieur a 20</h4>
                               @endif
                            </div></h4>
                        </div>
                        <a class="card-footer text-right" href="/admin/product/search?_token=aiafZiBH9y3YAgmxBAt3cK7q2iXEz6VFEetBQtXZ&qte=19&page=1" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-header"><i class="fa fa-shopping-bag"></i> Produits</div>
                        <div class="card-body">
                            <div class="card text-white bg-success" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 10px; top:20%; position: relative;">
                                    <i class='fa fa-shopping-cart' style="font-size: 100px; color: #ffffff; opacity: 60%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%; width: 206px; height: 8px;
                                     background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>
                            <div>

                                    <h4>Nombre total de produits : {{ $sum_pro }}</h4>
                                    <h4>Nombre total de catégories : {{ $sum_cat }}</h4>


                            </div>

                        </div>
                        <a class="card-footer text-right" href="/admin/tabbord/catprod" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 mb-3" >
                    <div class="card text-white bg-info">
                        <div class="card-header"><i class="fa fa-bar-chart"></i> Ventes</div>

                        <div class="card-body">
                            <div class="card text-white bg-success" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa-solid fa-sack-dollar' style="font-size: 100px; color: #ffffff; opacity: 60%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%; width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>
                            <h4 class="card-title">le produit le plus vendus :{{ $maxProductId }} quantite :{{ $maxQuantity }} </h4>
                            <h4 class="card-title">le produit le moins vendus :{{ $minProductId }} quantite :{{ $minQuantity }} </h4>
                        </div>
                        <a class="card-footer text-right" href="/admin/tabbord/tri_vente" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center" style="margin-left:180px;">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-header"><i class="fa fa-user-plus"></i> Utilisateurs</div>
                        <div class="card-body">
                            <!-- Conteneur de l'icône du panier avec le même arrière-plan -->
                            <div class="card text-white bg-primary" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa fa-users' style="font-size: 80px; color: #ffffff; opacity: 60%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%; width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>
                            <h4 class="card-title" style="margin-right:150px;">le nombre total des compte d'utilisateur: {{ $sum_compte }} </h4>
                        </div>
                        <a class="card-footer text-right" href="/admin/tabbord/utilisateur" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-header"><i class="fa fa-user-plus"></i> commandes
                        </div>
                        <div class="card-body">
                            <!-- Conteneur de l'icône du panier avec le même arrière-plan -->
                            <div class="card text-white bg-secondary" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa-solid fa-sack-dollar' style="font-size: 100px; color: #ff0000; opacity: 100%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%; width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>

                            <h4 class="card-title" style="margin-right:150px;"><div>
                                <h4>Nombre totale de  commandes  : {{ $data['paye'] +  $data['en_cours'] }}</h4>

                            </div></h4>
                        </div>
                        <a class="card-footer text-right" href="/admin/tabbord/commandes" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3" >
                    <div class="card text-white bg-info">
                        <div class="card-header"><i class="fa fa-bar-chart"></i> Revenus</div>

                        <div class="card-body">
                            <div class="card text-white bg-success" style="position: absolute; right: 0; top: 0; height: 100%;">
                                <div style="padding: 17px; top:20%; position: relative;">
                                    <i class='fa-solid fa-sack-dollar' style="font-size: 100px; color: #ffffff; opacity: 60%;"></i>
                                    <!-- Ligne inclinée -->
                                    <div style="position: absolute; left: -100px; top:45%; width: 206px; height: 8px; background-color: rgb(255, 255, 255); transform: rotate(-90deg);"></div>
                                </div>
                            </div>
                            <h5 class="card-title"> <div>
                                <h4>Moyenne mensuelle des revenus par année</h4>
                                <ul>
                                    @foreach($averageMonthlyRevenues as $year => $averageMonthlyRevenue)
                                        <li>Année: {{ $year }}, Moyenne mensuelle des revenus: {{ $averageMonthlyRevenue }}</li>
                                    @endforeach
                                </ul>
                            </div></h4>
                        </div>
                        <a class="card-footer text-right" href="/admin/tabbord/chiffre" style="color: white;">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div class="col-lg-8 col-md-8 col-sm-4 mb-2 mx-auto text-center">



</div>
    <main class="main" id="top">
        <div class="col-lg-4 col-md-8 col-sm-4 mb-2 mx-auto text-center">
            <!-- Sidebar and navigation included -->
            <canvas id="myChart"></canvas> <!-- Canvas for Chart.js -->

        </div>
    </main>




    <script src="{{asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js')}}"></script>

    </body>
    </html>
