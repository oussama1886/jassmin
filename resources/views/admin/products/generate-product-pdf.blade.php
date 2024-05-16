<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajout de bordures pour le tableau */
        table {
            border: 2px solid #dee2e6;
        }

        th, td {
            border: 2px solid #dee2e6;
            padding:8px;
            text-align: center;
        }

        .title {
            margin-bottom: 80px; /* Ajout d'une marge en bas */
        }
    </style>
</head>
<body>
    <div class="date-top-left">{{ $date }}</div>
    <div class="container">

        <div class="text-center title">
            <img  src="{{asset('mainassets/img/jasminshop.png')}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 145px;">
            <h3>{{ $title }}</h3>

            <h3>Nom du client: {{ $user_name[0] }}</h3>
            <h4>Commande numéro: {{ $commande_id }}</h4>
            <h4>téléphone: {{ $commande->delivery_phone }}</h4>
            <h4>addresse: {{ $commande->delivery_address}}</h4>
            <h4>methode de payement: {{ $commande->payment_method}}</h4>

        </div>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire(TND)</th>
                    <th>Taille</th>
                    <th>Couleur</th>
                    <th>somme</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lc as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $item->product->name }}</td> --}}

                    <td class=" mx-2">{{ $item->product->name }}</td>

                    <td>{{ $item->qte }}</td>
                    <td>{{ $item->product->price }} </td>
                    <td>@if ($item->size == 'null' || $item->size == '') -- @else {{ $item->size }} @endif</td>
                    <td>@if ($item->color == 'null' || $item->color == '') -- @else {{ $item->color }} @endif</td>
                    <td class="w-50 mx-2">{{ $item->product->price * $item->qte }} TND</td>


                </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="5"></td>
                    <td>Frais de livraison:</td>
                    <td>10 TND</td>
                </tr>
                <tr class="table-secondary">
                    <td colspan="5"></td>
                    <td><h3>Total:</h3></td>
                    <td><h4>{{ $commande->getTotalClient() }} TND</h4></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
