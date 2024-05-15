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
    <h2>date:{{ $date }}</h2>
    <h2>nom de client M\Mde:{{ $user_name }}</h2>
    <h4>commande numero :{{ $commande_id }}</h4>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>produit</th>
            <th>prix unitaire</th>
            <th>quantite</th>
            <th>taille</th>
            <th>couleur</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lc as $item )


        <tr>
<th> {{ $loop->iteration }}</th>
<th> {{ $item->product->name }}</th>
<th> {{ $item->product->price }}</th>
<th> {{ $item->qte }}</th>
<th> @if ( $item->size =='null'||$item->size =='')  --  @else {{ $item->size }} @endif </th>
<th> @if ( $item->color =='null'||$item->color =='')  --  @else {{ $item->color }} @endif </th>
        </tr>
        @endforeach
        <h4>frais de livraison : 10 dt</h4>
        <h4>total : {{ $commande->getTotalClient()}} dt</h4>
    </tbody>
</thead>
</table>
</body>
</html>
