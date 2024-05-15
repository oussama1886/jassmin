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
    <div class="container">
        <div class="text-center title">
            <h2>{{ $title }}</h2>
            <h3>Date: {{ $date }}</h3>
            <h3>Nom du client: {{ $user_name[0] }}</h3>
            <h4>Commande numéro: {{ $commande_id }}</h4>
        </div>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Taille</th>
                    <th>Couleur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lc as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->qte }}</td>
                    <td>@if ($item->size == 'null' || $item->size == '') -- @else {{ $item->size }} @endif</td>
                    <td>@if ($item->color == 'null' || $item->color == '') -- @else {{ $item->color }} @endif</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="4"></td>
                    <td>Frais de livraison:</td>
                    <td>10 dt</td>
                </tr>
                <tr class="table-secondary">
                    <td colspan="4"></td>
                    <td>Total:</td>
                    <td>{{ $commande->getTotalClient() }} dt</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
