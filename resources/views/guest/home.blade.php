
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JasminShop </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <style>
        /* Styles pour agrandir les boutons */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Styles pour placer les boutons de chaque côté */
        .input-group-prepend button,
        .input-group-append button {
            font-size: 18px;
            padding: 5px 10px;
            line-height: 1;
        }
    </style>
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
    <link href="{{ asset ('mainassets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    @include('inc.guest.Topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('inc.guest.navbar')
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
  <!--  include(inc.guest.categories)-->

    <!-- Categories End -->


    <!-- Offer Start -->
      <!--include('inc.guest.offer')-->
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($produits as $p)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <a href="/product/details/{{ $p->id }}">
                            <img class="img-fluid w-100" src="{{ asset('uploads/'.$p->photo) }}" alt="">
                        </a>

                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $p->name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{ $p->price }} TND</h6><h6 class="text-muted ml-2"><del>@if ($p->old_price){{$p->old_price}} TND @endif</del></h6>
                            <!--<h6 class="text-muted ml-2"><del>$123.00</del></h6>    prix de solde -->
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border align-items-center">
                        <a href="/product/details/{{ $p->id }}" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>View Detail</a>




                          {{--   <form action="/client/order/store" method="POST">
                                @csrf
                                <div class="d-flex align-items-center mb-4 pt-2">
                                    <input type="hidden" value="{{ $p->id }}" name="product">
                                    <div class="input-group quantity mr-1" style="width: 120px;">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-minus" onclick="decrementQuantity('{{ $p->id }}')">
                                                <i class="fas fa-caret-down"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control bg-secondary text-center" value="1" name="qte" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-plus" onclick="incrementQuantity('{{ $p->id }}')">
                                                <i class="fas fa-caret-up"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i></button>
                                </div>
                            </form> --}}



                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="col-12 pb-1">
            <nav aria-label="Page navigation ">
                <div class="row">
                    <div class="col-lg-5 col-md-5">

                    </div>
                    <div class="col-lg-4 col-md-4">
                        {!! $produits->links() !!}

                    </div>
                </div>



            </nav>
        </div>

    <!-- Products End -->


    <!-- Subscribe Start -->

    <!-- Subscribe End -->

    <!--include('inc.guest.subscribe')-->

    <!-- Products Start -->

    <!-- Products End -->


    <!-- Vendor Start -->

    <!-- Vendor End -->


    <!-- Footer Start -->


@include('inc.guest.footer')
<!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('mainassets/lib/easing/easing.min.js')}}"></script>



    <script src="{{ asset('mainassets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('mainassets/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('mainassets/ mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('mainassets/js/main.js')}}"></script>
    <!-- Sur la page 'http://jasminshop.test' -->
<script>
    // Vérifier si un message de succès est présent dans la session flash
    var successMessage = "{{ session('success_message') }}";
    if (successMessage) {
        // Afficher le message de succès dans une alerte ou une boîte de dialogue
        alert(successMessage);
        // Définir un minuteur pour faire disparaître l'alerte après 5 secondes (5000 millisecondes)
      /*   setTimeout(function() {
            $('.alert').alert('close'); // Fermer l'alerte
        }, 5000); */
    }
</script>

</body>

</html>
