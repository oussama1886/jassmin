<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
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
    <link href="{{ asset ('mainassets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="http://jasminshop.test" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5 col-3" style="margin-top: 0px; margin-right: -420px; margin-left:0px;">
                <div class=" text-left">
                    @auth
                <a href="" class="btn border">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge">
                        {{-- afficher le nom de client  --}}
                        @php
                            $clientName = null; // Initialisation du nom du client à null
                        @endphp

                        @foreach(auth()->user()->commandes as $index => $commande)
                            @if(is_null($clientName))
                                <td>{{ $commande->client->name }}</td>
                                @php $clientName = $commande->client->name; @endphp
                            @endif
                        @endforeach
                        @endauth</span>
                </a>



                <a href="http://jasminshop.test/client/cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">   @auth

           @foreach(auth()->user()->commandes as $commande)
               @php
                   $qtte = 0; // Initialisation de la variable qtte pour stocker la somme des quantités
               @endphp
               @foreach($commande->lignecommandes as $lignec)
                   @if ($commande->etat == "en cours")
                       @php
                           $qtte += $lignec->qte; // Ajouter la quantité de chaque ligne de commande à la somme
                       @endphp
                   @endif
               @endforeach
               @if ($commande->etat == "en cours")


                               <!-- Vous pouvez ajouter n'importe quel contenu lié à l'en-tête de la commande ici -->

                           {{-- <h6 class="text-truncate mb-5"> {{ $commande->etat }}</h6> --}}
                          {{--  <td> {{ $commande->client->name}} </td> --}}
                           {{-- <h6 class="text-truncate mb-ihgfx"> {{ $commande->getTotal() }} TND</h6> --}}

                               {{-- <h6 class="text-truncate mb-5 mt-4">{{ $lignec->id }}</h6> --}}


                                   <h6 class="d-flex justify-content-around  mb-0 ml-1">{{ $qtte }}</h6>
                                </span>







               @endif
           @endforeach

    @endauth
    </span>
                </a>
        </div>
    </div>
        </div>
    </div>

    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="http://jasminshop.test" class="nav-item nav-link">Home</a>
                            <a href="shop.html" class="nav-item nav-link">Shop</a>
                            <a href="" class="nav-item nav-link active">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="http://jasminshop.test.client.cart" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                           <a href="/guest/contact" class="nav-item nav-link">Contact</a>

                        </div>

                        <div class="col-lg-5 col-6 text-right" style="margin-top: -147px; margin-right:-450px;">
                            <div class="btn border">


                        @auth

                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign out</a>
                              <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class='fas fa-sign-out-alt' style='color:#f38d39'></i></i></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                    @else
                        <div class="navbar-nav ml-auto py-0">
                            <a href="/login" class="nav-item nav-link">Login</a>
                            <a href="/register" class="nav-item nav-link">Register</a>
                        </div>
                    @endauth
                    </div>

            </div>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="http://jasminshop.test">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100"  src="{{asset('uploads')}}/{{$product->photo}}" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100"  src="{{asset('mainassets/img/product-2.jpg')}}" alt="Image">
                        </div>


                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mb-2">
                        <!-- a revoir pour afficher la moyenne des etoile pour chque produits-->
                        @for ($i =0 ; $i <count($product->reviews) ; $i++)

                           <i class="fas fa-star"></i>
                        @endfor


                    </div>
                    <small class="pt-1">{{ count($product->reviews) }} Avis</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{$product->price}}TND</h3>
                <p class="mb-4">{{$product->description}}</p>



        {{--  <form action="produit/sisco"  method="POST" > --}}



    <div class="d-flex mb-3">


        @php
            // Trier les tailles de manière unique et personnalisée
            $uniqueSizes = $sizecolors->unique('size');

            // Trier les tailles de manière personnalisée
            $sortedSizes = $uniqueSizes->sortBy(function ($sizecolor) {
                // Si la taille est un nombre, ordonne les tailles numériquement
                if (is_numeric($sizecolor->size)) {
                    return intval($sizecolor->size);
                } else {
                    // Sinon, définir un ordre personnalisé pour les tailles alphabétiques
                    $order = ['S', 'M', 'L', 'XL', 'XXL']; // ou tout autre ordre personnalisé que vous souhaitez
                    return array_search($sizecolor->size, $order);
                }
            });
        @endphp
@if(count($sortedSizes) > 0)
@php
    $hasSizes = false;
    $hasColors = false;

    foreach ($sortedSizes as $sizecolor) {
        if ($sizecolor->size !== 'null') {
            $hasSizes = true;
        } else {
            $hasColors = true;
        }
    }
@endphp

@if ($hasSizes)
    <p class="text-dark font-weight-medium mb-0 mr-3">sizes :</p>
@else
    <p class="text-dark font-weight-medium mb-0 mr-3">couleurs :</p>
@endif



@foreach ($sortedSizes as $sizecolor)
    @if (($sizecolor->size)!=='null')
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input size-radio" id="{{ $sizecolor->size }}" name="size" data-size="{{ $sizecolor->size }}">
            <label class="custom-control-label" for="{{ $sizecolor->size }}">{{ $sizecolor->size }}</label>
        </div>
    @endif
@endforeach
@endif

    </div>

    <div class="d-flex mb-4" id="colors-section">
        <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sélectionner par défaut la première taille et la première couleur si elles existent
            var defaultSize = $('.size-radio:first').data('size');
            var defaultColor = '';

            if (defaultSize) {
                // Récupérer les couleurs correspondant à la taille sélectionnée
                var colors = <?php echo json_encode($sizecolors->toArray()); ?>;
                var uniqueColors = colors.filter(function(color) {
                    return color.size === defaultSize;
                }).map(function(color) {
                    return color.color;
                });

                if (uniqueColors.length > 0) {
                    defaultColor = uniqueColors[0];
                }
            }

            // Sélectionner par défaut la première taille
            if (defaultSize) {
                $('input[type="radio"][data-size="' + defaultSize + '"]').prop('checked', true);
            }

            // Sélectionner par défaut la première couleur
            if (defaultColor) {
                $('input[type="radio"][data-color="' + defaultColor + '"]').prop('checked', true);
            }

            // Fonction pour mettre à jour les couleurs en fonction de la taille sélectionnée
            function updateColors(selectedSize) {
    // Effacer les couleurs actuellement affichées
    $('#colors-section').empty();

    // Récupérer les données de tailles et couleurs
    var colors = <?php echo json_encode($sizecolors->toArray()); ?>;

    // Vérifier s'il existe des articles avec uniquement des couleurs
    var colorsOnly = colors.filter(function(color) {
        return color.color !== 'null' && color.size === 'null';
    });

    // Si l'article est disponible uniquement en couleur, afficher les couleurs disponibles avec leur quantité
    if (colorsOnly.length > 0) {

//ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
        colorsOnly.forEach(function(colorItem) {
            var quantity = colorItem.qte;
if (quantity < 10){
     var quantityText ='(' + quantity + ' Article restant)';
        if (quantity > 1) {
            quantityText =' (' + quantity + ' Articles restant)';
        }


}  else{
            quantityText='';
        }



        var colorText = '' + colorItem.color;

        var colorRadio = $('<div class="custom-control custom-radio custom-control-inline">' +
                                '<input type="radio" class="custom-control-input" id="' + colorItem.color + '" name="color" data-color="' + colorItem.color + '">' +
                                '<label class="custom-control-label" for="' + colorItem.color + '">' + colorText +   quantityText + '</label>' +
                            '</div>');
                            $('#colors-section').append(colorRadio);
        });

        return;
    }

    // Si l'article n'est pas disponible uniquement en couleur, afficher les couleurs disponibles pour la taille sélectionnée
    var availableColors = colors.filter(function(color) {
        return color.size === selectedSize && color.color !== 'null';
    });



    // Afficher les couleurs disponibles avec leurs quantités
    availableColors.forEach(function(colorItem) {
        var quantity = colorItem.qte;
        var color = colorItem.color;

        if (quantity < 10){
     var quantityText ='(' + quantity + ' Article restant)';
        if (quantity > 1) {
            quantityText =' (' + quantity + ' Articles restant)';
        }


}  else{
            quantityText='';
        }


        var colorRadio = $('<div class="custom-control custom-radio custom-control-inline">' +
                                '<input type="radio" class="custom-control-input" id="' + color + '" name="color" data-color="' + color + '">' +
                                '<label class="custom-control-label" for="' + color + '">' + color  + quantityText + '</label>' +
                            '</div>');
        $('#colors-section').append(colorRadio);
    });

    // Vérifier s'il existe des articles avec uniquement des tailles et les afficher
    var sizesOnly = colors.filter(function(color) {
        return color.size === selectedSize && color.color === 'null';
    });

    if (sizesOnly.length > 0) {


    sizesOnly.forEach(function(sizeItem) {
        var quantity = sizeItem.qte;
        if (quantity < 10){
     var quantityText ='(' + quantity + ' Article restant)';
        if (quantity > 1) {
            quantityText =' (' + quantity + ' Articles restant)';
        }


}  else{
            quantityText='';
        }




        var sizeRadio = $('<div class="custom-control  custom-control-inline">' +
                                '<input type="radio" class="custom-control-input" id="' + sizeItem.size + '" name="size" data-size="' + sizeItem.size + '">' +
                                '<label  for="' + sizeItem.size + '">'  + quantityText + '</label>' +
                            '</div>');
        $('#colors-section').append(sizeRadio);
    });
}


}



            // Mettre à jour les couleurs lorsque la taille est modifiée
            $('.size-radio').change(function() {
                var selectedSize = $(this).data('size');
                updateColors(selectedSize);
            });

            // Afficher les couleurs par défaut
            updateColors(defaultSize);

        });
    </script>






                <div class="d-flex align-items-center mb-4 pt-2">


                    <form action="/client/order/store"  method="POST">
                        @csrf


                          <div class="d-flex align-items-center mb-4 pt-2">
                            <input type="hidden" value="{{ $product->id }}" name="product">
                            <div class="input-group quantity mr-1" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control bg-secondary text-center" value="1" name="qte">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>

                            </div>
                          </div>


                            <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>


                      </div>
                    </form>


                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Avis ({{ count($product->reviews) }})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{$product->description}}</p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">{{ count($product->reviews) }} Avis</h4>
                                @foreach($product->reviews as $review)
                                <div class="media mb-4">
                                    <img  src="{{asset('mainassets/img/user.jpg')}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>{{ $review->user->name }}<small> - <i>{{ $review->created_at }}</i></small></h6>
                                        <div class="text-primary mb-2">
                                            @for ($i =0 ; $i <$review->rate ; $i++)
                                               <i class="fas fa-star"></i>
                                            @endfor


                                        </div>
                                        <p> {{ $review->content }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>

                                <form action="/client/review/store" method="POST">
                                    @csrf
                                    <input type="hidden"  value="{{$product->id }}" name="product_id">
                                <div class="form-group">
                                    <label class="mb-0 mr-2" for="rating">Votre évaluation * :</label>
                                    <input type="number" max="5" min="1" class="form-control small-rating" name="rate" />
                                </div>



                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea  cols="30" rows="5" class="form-control" name="content"></textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">

                <div class="owl-carousel related-carousel">
                    @foreach ($produits as $prod )


                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100"   src="{{asset('uploads')}}/{{$prod->photo}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$prod->name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{$prod->price}}TND</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="/product/details/{{ $prod->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- Products End -->


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
    </body>

    </html>
