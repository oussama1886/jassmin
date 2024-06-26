<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JasminShop </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('mainassets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('mainassets/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            width: 100vw;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            padding: 20px;
        }

        .product-item {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    @include('inc.guest.Topbar')
    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('inc.guest.nav')
    <!-- Navbar End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <!-- Optionally, you can add a title or description here -->
                    </div>

                    <div class="container-fluid px-5 pb-3">
                        <div class="row">
                            @foreach ($produits as $p)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <a href="/product/details/{{ $p->id }}">
                                            <img class="img-fluid w-100" src="{{ asset('uploads/'.$p->photo) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $p->name }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{ $p->price }} TND</h6>
                                            <h6 class="text-muted ml-2"><del>@if ($p->old_price){{ $p->old_price }} TND @endif</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border align-items-center">
                                        <a href="/product/details/{{ $p->id }}" class="btn btn-sm text-dark p-0">
                                            <i class="fas fa-eye text-primary mr-1"></i>Voir les détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <!-- Liens de pagination -->
                            <!-- Afficher les liens de pagination avec les paramètres de recherche -->
                            {{ $produits->appends(['keywords' => request()->keywords])->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Footer Start -->
    @include('inc.guest.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('mainassets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('mainassets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mainassets/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mainassets/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('mainassets/js/main.js') }}"></script>
</body>

</html>
