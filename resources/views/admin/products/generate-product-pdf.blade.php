<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <h2>{{ $title }}</h2>
    <h2>{{ $date }}</h2>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Id commande</th>
            <th>produit</th>
            <th>quantite</th>
            <th>taille</th>
            <th>couleur</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lc as $item )


        <tr>
<th> {{ $item->commande_id }}</th>
<th> {{ $item->product_id }}</th>
<th> {{ $item->qte }}</th>
<th> @if ( $item->size =='null'||$item->size =='')  --  @else {{ $item->size }} @endif </th>
<th> @if ( $item->color =='null'||$item->color =='')  --  @else {{ $item->color }} @endif </th>
        </tr>
        @endforeach
    </tbody>
</thead>
</table>
</body>
</html>
