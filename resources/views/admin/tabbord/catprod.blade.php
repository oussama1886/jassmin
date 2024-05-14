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
                        <h1> categories/produits </h1>

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
                            <table class="table table-bordered border-primary text-center align-middle" style="background-color: #e6ecf1;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category ID</th>
                                        <th scope="col">Nom categorie</th>
                                        <th scope="col">nombre des articles</th>
                                        <th scope="col">qtite totale des produits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr class="text-center align-middle">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $category->id }}</td> <!-- Afficher le category_id -->
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $countProductsByCategory->where('category_id', $category->id)->first()->total ?? 0 }}</td>
                                            <td>{{ $sums[$category->name] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>





                    </div>
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
