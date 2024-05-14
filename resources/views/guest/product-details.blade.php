
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
    <link href="{{ asset ('mainassets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    @include('inc.guest.Topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('inc.guest.navb')
    <!-- Navbar End -->
    <!-- Page Header End -->



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
                            <img class="w-100 h-100"  src="{{asset('uploads')}}/{{$product->imag_one}}" alt="Image">
                        </div>

                        <div class="carousel-item">
                            <img class="w-100 h-100"  src="{{asset('uploads')}}/{{$product->imag_two}}" alt="Image">
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
                <h3 class="font-weight-semi-bold mb-4">{{$product->price}} TND</h3><h6 class="text-muted ml-2"><del>@if ($product->old_price){{$product->old_price}} TND @endif</del></h6>
                @if ($product->qte < 10)
                    <h3 class="font-weight-semi-bold mb-4">Quantité restante : {{$product->qte}}</h3>
                @endif

                <p class="mb-4">{{$product->description}}</p>



        {{--  <form action="produit/sisco"  method="POST" > --}}
            {{-- <form action="/guest/aff" method="POST" id="order-form"> --}}
     <form action="/client/order/store" method="POST" id="order-form">
                @csrf
                <!-- Champs cachés pour la taille et la couleur -->
                <input type="hidden" name="size" id="selected-size">
                <input type="hidden" name="color" id="selected-color">

                <!-- Div pour les tailles -->
                <div class="d-flex mb-3">
                    @if($sortedSizes->isNotEmpty())
                        <p class="text-dark font-weight-medium mb-0 mr-3">Tailles :</p>
                        @php $firstSize = true; @endphp
                        @foreach ($sortedSizes as $sizecolor)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input size-radio" id="{{ $sizecolor->size }}" name="size" value="{{ $sizecolor->size }}" data-size="{{ $sizecolor->size }}" data-color="{{ $sizecolor->color }}" data-qte="{{ $sizecolor->qte }}" @if($firstSize) checked @php $firstSize = false; @endphp @endif>
                                <label class="custom-control-label" for="{{ $sizecolor->size }}">{{ $sizecolor->size }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>


               <!-- Div pour les couleurs -->
<div class="d-flex mb-4" id="colors-section">
    <p class="text-dark font-weight-medium mb-0 mr-3">@if ($hasColors)Couleurs :@endif</p>
    @php $firstColor = true; @endphp
    @foreach ($uniquecolor as $color)
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input color-radio" id="{{ $color->color }}" name="color" value="{{ $color->color }}" data-color="{{ $color->color }}" @if($firstColor) checked @php $firstColor = false; @endphp @endif>
            <label class="custom-control-label" for="{{ $color->color }}">@if ($hasColors){{ $color->color }}@endif</label>
        </div>
    @endforeach
</div>


                <!-- Affichage de la quantité -->
                <div id="qte-display"></div>


                <div id="message"></div>


                <!-- Div pour la quantité -->
                <div class="d-flex align-items-center mb-4 pt-2">
                    <input type="hidden" value="{{ $product->id }}" name="product">
                    <div class="input-group quantity mr-1" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus">
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
        <button type="submit" class="btn btn-primary px-3">
            <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
        </button>
    </div>
</form>

<!-- JavaScript pour la validation -->
<script>
    // Fonction pour la validation de la quantité
    function validateQuantity() {
        var quantityInput = document.querySelector('input[name="qte"]');
        var qte  = parseInt(quantityInput.value);


        if (qte <= 10 && qte> {{ $product->qte }}){
                 alert("La quantité maximum demandé ne peut pas dépasser la quantité disponible"+{{ $product->qte }});
        return false;
        }

        if (qte > 10) {
            alert("La quantité maximum demandé ne peut pas dépasser 10.");
            return false; // Empêche le formulaire de se soumettre
        }
        return true; // Permet au formulaire de se soumettre si la quantité est valide
    }

    // Attacher l'événement onsubmit au formulaire pour la validation
    document.getElementById('order-form').onsubmit = validateQuantity;

    // Autres scripts JavaScript pour la mise à jour de la quantité
</script>
<!-- Affichage de la quantité -->
<div id="qte-display"></div>
<!-- Affichage de la quantité -->
<div id="qte-display"></div>

<script>
    // Récupérer les données de taille et de couleur de la base de données depuis PHP
    var sizeColorData = @json($sizecolors);

    // Fonction pour trouver la quantité pour la taille et la couleur sélectionnées
    function findQuantityForSelection(size, color) {
        for (var i = 0; i < sizeColorData.length; i++) {
            if (sizeColorData[i].size === size && sizeColorData[i].color === color) {
                return sizeColorData[i].qte;
            }
        }
        return 'N/A'; // Non disponible si la combinaison n'est pas trouvée
    }

    // Fonction pour afficher la quantité
    function updateQuantityDisplay() {
    var selectedSize = document.querySelector('input[name="size"]:checked').dataset.size;
    var selectedColor = document.querySelector('input[name="color"]:checked').dataset.color;
    var quantity = findQuantityForSelection(selectedSize, selectedColor);
    var qteDisplay = document.getElementById('qte-display');

    if (quantity === 'N/A') {
        qteDisplay.innerText = "Non disponible";
        qteDisplay.style.color = "red"; // Couleur du texte en rouge pour indiquer la non-disponibilité
    } else if (quantity < 10) {
        qteDisplay.innerText = "Quantité disponible : " + quantity;
        qteDisplay.style.color = "blue"; // Couleur du texte en bleu pour indiquer une faible disponibilité
    } else {
        qteDisplay.innerText = "Disponible";
        qteDisplay.style.color = "green"; // Couleur du texte en vert pour indiquer une disponibilité suffisante
    }
 }


    // Attacher les gestionnaires d'événements aux boutons radio
    document.querySelectorAll('input[name="size"], input[name="color"]').forEach(function(radio) {
        radio.addEventListener('change', updateQuantityDisplay);
    });

    // Appel initial pour afficher la quantité
    updateQuantityDisplay();

    function validateQuantity() {
        var selectedSize = document.querySelector('input[name="size"]:checked').dataset.size;
    var selectedColor = document.querySelector('input[name="color"]:checked').dataset.color;
    var quantity = findQuantityForSelection(selectedSize, selectedColor);
    var qteDisplay = document.getElementById('qte-display');
        var quantityInput = document.querySelector('input[name="qte"]');
        var qte = parseInt(quantityInput.value);
        if (quantity === 'N/A') {
            alert("article non disponible.");
            return false; // Empêche le formulaire de se soumettre
        }
        if (qte > 10) {
            alert("La quantité maximum demandé ne peut pas dépasser 10.");
            return false; // Empêche le formulaire de se soumettre
        }
        if (qte >  quantity && qte <=10 ) {
            alert("La quantité maximum demandé ne peut pas dépasser la qte dispo "+ quantity);
            return false; // Empêche le formulaire de se soumettre
        }
        return true; // Permet au formulaire de se soumettre si la quantité est valide
    }

    // Attacher l'événement onsubmit au formulaire pour la validation
    document.getElementById('order-form').onsubmit = validateQuantity;
</script>






                <div class="d-flex align-items-center mb-4 pt-2">




                      </div>
                    </form>

                </div>
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
                                <h6 class="text-muted ml-2"><del>$123.00</del></h6>  <h6>{{$prod->price}}TND</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="/product/details/{{ $prod->id }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                           {{--  <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> --}}
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
