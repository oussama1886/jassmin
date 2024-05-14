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
            <th>Id</th>
            <th>Name</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item )


        <tr>
<th> {{ $item->id }}</th>
<th> {{ $item->name }}</th>
<th> {{ $item->price }}</th>
        </tr>
        @endforeach
    </tbody>
</thead>
</table>
</body>
</html>
