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
    <style>
      body {
        opacity: 0;
      }
    </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">

        @include('inc.admin.sidebar')


        @include('inc.admin.nav')


        <div class="content">
            <div class="pb-5">
                <div class="row g-5">
                    <h1> details de commande </h1>

                    <hr />

                    <div class="div">
                        <div class="row">
                            <div class="col-md-4">

                            </div>

                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <table class="table table-bordered border-primary custom-table">
                            <!-- Table header -->
                            <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Commande ID</th>
                                    <th scope="col">LC ID</th>
                                    <th scope="col">LC Quantité</th>
                                    <th scope="col">Produit ID</th>
                                    <th scope="col">Produit</th>

                                    <th scope="col">Photo</th>
                                    <th scope="col">Prix</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <!-- Loop through paginated products -->
                                @php
                                    $totalPrice = 0; // Initialisation de la variable pour stocker la somme des prix
                                @endphp
                                @foreach ($lc as $key => $lcc)
                                <tr>
                                    <!-- Affichage de l'index incrémenté -->
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lcc->commande_id }}</td>
                                    <td>{{ $lcc->id }}</td>
                                    <td>{{ $lcc->qte }}</td>
                                    <td>{{ $lcc->product_id }}</td>
                                    <td>{{ $lcc->product->name }}</td>

                                    <td><img src="{{ asset('uploads') }}/{{ $lcc->product->photo }}" width="80" alt=""></td>
                                    <td>{{ $lcc->product->price }} TND</td>
                                </tr>

                                @endforeach
                                <!-- Affichage de la somme des prix -->
                            </tr>
                            <!-- Ligne Total -->
                            <tr>
                                <!-- Colspan pour les 6 premières colonnes -->
                                <td colspan="6"></td>
                                <!-- Colonnes pour le texte "Total" et le montant -->
                                <td class="font-weight-bold" colspan="1">Total:</td>
                                <td class="table-secondary font-weight-bold total-price" colspan="1">   {{$lcc->commande->getTotal() }} TND</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


    <!-- Inclusion des scripts JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Afficher le corps de la page une fois qu'elle est chargée
        document.body.style.display = "block";</script>

    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>
</html>
