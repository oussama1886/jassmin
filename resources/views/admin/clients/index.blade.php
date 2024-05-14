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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
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
                        <h1> liste de clients </h1>

                        <hr />
 {{-- recherche de client --}}
<div class="mt-2">
    <form action="/admin/clients/search" method="POST">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="etat"><span style="font-weight: bold;"> veulliez tapez le id et / ou le nom de client :</span></label>
            </div>
            <div class="col-2">

                <input type="number"  class="form-control" name="id_client" placeholder="id client" min=0>
            </div>

            <div class="col-2">
                <input type="text" class="form-control" name="user_name" placeholder="Tapez un nom de client">
            </div>
            <div class="col-2">
                <label for="etat"><span style="font-weight: bold;">veillez Choisir l'état du client :</span></label>
            </div>
            <div class="col-2">
                <select class="form-control" id="etat" name="etat">
                    <option value="0">Tout</option>
                    <option value="1">Actif</option>
                    <option value="all">Inactif</option>
                </select>
            </div>
            <div class="col-2">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
</div>





<div class="mt-3 text-center">
    <table class="table table-bordered border-primary" style="background-color: #e6ecf1;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id_client</th>
                <th scope="col">Nom client</th>
                <th scope="col">Email</th>
                <th scope="col">Etat</th>
                <th scope="col">Desactivation</th>
                <th scope="col">Activation</th>
                <th scope="col">Commandes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $index => $client)
            @if ($client->role == 'user')
            <tr>
                <th>{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->index + 1 }}</th>
                <th>{{$client->id}}</th>
                <th>{{ $client->name }}</th>
                <th>{{ $client->email }}</th>
                <th>
                    @if($client->is_active)
                    <span class="badge bg-primary">Utilisateur Active</span>
                    @else
                    <span class="badge bg-secondary text-white">Utilisateur Bloqué</span>
                    @endif
                </th>
                <th><a href="/admin/user/{{$client->id}}/bloquer" class="btn btn-danger">Bloqué</a> </th>
                <th><a href="/admin/user/{{$client->id}}/debloquer" class="btn btn-success">Debloqué</a> </th>
                <td><a href="/admin/commandes/client_commande/{{$client->id}}" class="btn btn-info">voir les commandes</a></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $clients->appends(request()->input())->links('pagination::bootstrap-5', ['class' => 'pagination-sm']) }}
    </div>
</div>






            <footer class="footer">
                <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">v1.1.0</p>
                    </div>
                </div>
            </footer>
        </div>
        </div>
    </main>






    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>
