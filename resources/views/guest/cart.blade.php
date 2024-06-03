<!DOCTYPE html>
<html lang="en">
   {{--------------------------------  $sessionId = session()->getId(); ------------------------------}}

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
    <!-- JavaScript pour la validation de la date d'expiration de la carte de crédit -->

    <style>
        {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    width: 100vw;
                    overflow-x: hidden;
                    font-family: Arial, sans-serif;
                }

                .container {
                    max-width: 100%;
                    width: 100%;
                    margin: 0 auto;
                    padding: 20px;
                }

                .header, .content, .footer {
                    width: 100%;
                    padding: 20px;
                    background-color: #f4f4f4;
                    margin-bottom: 10px;
                }
                </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">

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
            <img  src="{{ asset("/dashassets/img/team/jasminshop.png") }}" alt="User-Profile-Image" width="150" height="120">
            <div class="col-lg-3 d-none d-lg-block">

                <a href="http://jasminshop.test" class="text-decoration-none">

                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop</h1>
                </a>
            </div>


            <div class="col-lg-3 col-6 text-right">
            </div>
                <div class="col-lg-3 col-6 text-right">
                @auth

                @if(!empty(auth()->user()->photo))
                <img class="rounded-circle" src="{{ asset('dashassets/img/client/'. auth()->user()->photo) }}" alt="User-Profile-Image" width="60" height="60">
                @else
                <!-- Photo standard -->
                <img class="rounded-circle" src="{{ asset('dashassets/img/client/profile.png') }}" alt="User-Profile-Image" width="60" height="60">
                @endif


                    <a href="http://jasminshop.test/client/dashboard" class="btn border">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge">

                        {{-- afficher le nom de client  --}}
                       {{-- Afficher le nom du client --}}
                       @php
                       $clientName = null; // Initialisation du nom du client à null
                   @endphp

                   {{-- Utilisation de @if plutôt que @foreach --}}
                   @if(is_null($clientName))
                       {{ auth()->user()->name }}
                       @php $clientName = auth()->user()->name; @endphp

                   @endif
               </span>
            </a>
           </a>
       @endauth



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
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">


                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->





    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Panier</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Panier</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


   <!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>taille</th>
                        <th>couleur</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @if(isset($commande))
                    @foreach ($commande->lignecommandes as $lc)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('uploads') }}/{{ $lc->product->photo }}"
                             alt="" style="width: 50px;"> {{ $lc->product->name }}</td>
                        <td class="align-middle">{{ $lc->product->price }} TND</td>
                        @if ($lc->product->qte >= $lc->qte)
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                {{$nbre= $lc->qte }}
                            </div>
                        </td>
                        @else
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <span style="color: rgb(230, 13, 215);">{{ $lc->qte }} demandé</span>
                                <span style="color: rgb(219, 39, 69);">{{$lc->qte=$nbre= $lc->product->qte }} quantité  disponible(s)</span>

                            </div>
                        </td>
                        @endif
                        <td class="align-middle">@if ( $lc->size =='null'||$lc->size =='')  --  @else {{ $lc->size }} @endif </td>
                        <td class="align-middle">@if ( $lc->color =='null'||$lc->color =='')  --  @else {{ $lc->color }} @endif </td>
                        <td class="align-middle">{{ $lc->product->price * $nbre }}</td>
                        <td class="align-middle">
                            <form action="/client/checkout" method="POST">
                                @csrf
                                <input type="hidden" name="commande_id" value="{{ $commande->id }}">
                                <input type="hidden" name="size" value="{{ $lc->size }}">
                                <input type="hidden" name="color" value="{{ $lc->color }}">
                                @if ($commande->etat == 'en cours')
                    <a href="/client/lc/{{ $lc->id }}/destroy" class="btn btn-sm btn-primary"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ligne de commande ?');">
                        <i class="fa fa-times"></i>
                    </a>
                @endif

                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="7" class="text-center">
                            <p>Aucun produit dans votre panier.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.col-lg-8 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid pt-5 -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="col-lg-4">


            </div>
        </div>
    </div>
    <!-- Cart End -->
<!-- Modal de confirmation de paiement -->
@if(isset($commande))
@if(isset($lc))
<div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="text-center" colspan="2"> <!-- Alignement au centre et colspan pour fusionner les deux colonnes -->
                    <h3 class="font-weight-medium">Subtotal </h3>
                </td>
                <td class="text-end"> <!-- Alignement à l'extrême droite -->
                    <h3 class="font-weight-medium">{{$commande->getTotalClient()-10}} TND</h3>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="d-flex flex-column justify-content-center align-items-center vh-0">
<button type="button" id="paymentModalButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Paiement</button>
</div>
@else
<div class="d-flex flex-column justify-content-center align-items-center vh-0">
<h4>Votre panier est vide <h4>
</div>
@endif
@endif
<!-- Modal de confirmation de paiement -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Mode de paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" action="/client/checkout" method="POST">
                    @csrf
                    @if(isset($commande))
                        <input type="hidden" name="commande_id" value="{{ $commande->id }}">
                        @if(isset($lc))
                            <input type="hidden" name="size" value="{{ $lc->size }}">
                            <input type="hidden" name="color" value="{{ $lc->color }}">
                        @endif
                    @endif

                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Subtotal</h6>
                                <h6 class="font-weight-medium">{{$commande->getTotalClient()-10}} TND</h6>
                            </div>
                            @if ($commande->getTotalClient() - 10 > 0)
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Livraison</h6>
                                    <h6 class="font-weight-medium">10 TND</h6>
                                </div>
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total</h5>
                                    <h5 class="font-weight-bold">{{ $commande->getTotalClient() }} TND</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
                <div class="form-group">
                    <label for="paymentMethod" class="font-weight-bold ">Mode de paiement :</label>
                    <select class="form-control bg-info " id="paymentMethod" name="paymentMethod">
                        <option value="livraison">Paiement à la livraison</option>
                        <option value="enligne">Paiement en ligne</option>
                    </select>
                </div>



                <!-- Champs pour le paiement en ligne -->
                <div id="onlinePaymentFields" style="display: none;">
                    <div class="form-group">
                        <label for="cardNumber" class="font-weight-bold ">Numéro de carte :</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expiryMonth" class="font-weight-bold ">Mois d'expiration :</label>
                            <select class="form-control" id="expiryMonth" name="expiryMonth" required>
                                <option value="">Sélectionnez le mois</option>
                                <option value="01">Janvier</option>
                                <option value="02">Février</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">Juillet</option>
                                <option value="08">Août</option>
                                <option value="09">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="expiryYear" class="font-weight-bold ">Année d'expiration :</label>
                            <input type="text" class="form-control" id="expiryYear" name="expiryYear" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cvc" class="font-weight-bold ">Code CVC :</label>
                        <input type="text" class="form-control" id="cvc" name="cvc" required>
                    </div>
                </div>
                <!-- Champs pour l'adresse de livraison et le contact -->
                <div id="deliveryContactFields">
                    <div class="form-group">
                        <label for="phoneNumber"  class="font-weight-bold ">Numéro de téléphone :</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="deliveryAddress" class="font-weight-bold ">Adresse de livraison :</label>
                        <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" value="{{ auth()->user()->adress }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-weight-bold ">Adresse e-mail :</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmPayment">Confirmer le paiement</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('paymentModalButton').addEventListener('click', function() {
        $('#paymentModal').modal('show');
    });

    document.getElementById('paymentMethod').addEventListener('change', function() {
        if (this.value === 'enligne') {
            document.getElementById('onlinePaymentFields').style.display = 'block';
        } else {
            document.getElementById('onlinePaymentFields').style.display = 'none';
        }
    });

    document.getElementById('confirmPayment').addEventListener('click', function() {
        var paymentMethod = document.getElementById('paymentMethod').value;
        var phoneNumberInput = document.getElementById('phoneNumber');
        var deliveryAddressInput = document.getElementById('deliveryAddress');
        var emailInput = document.getElementById('email');

        var phoneNumber = phoneNumberInput.value.trim();
        var deliveryAddress = deliveryAddressInput.value.trim();
        var email = emailInput.value.trim();

        // Fonction pour ajouter un message d'erreur sous l'élément
        function addErrorMessage(element, message) {
            var errorElement = document.createElement('div');
            errorElement.textContent = message;
            errorElement.classList.add('invalid-feedback');
            element.classList.add('is-invalid');
            element.parentNode.appendChild(errorElement);
        }

        // Fonction pour retirer les messages d'erreur et la mise en forme de l'élément
        function clearError(element) {
            element.classList.remove('is-invalid');
            var errorMessages = element.parentNode.querySelectorAll('.invalid-feedback');
            errorMessages.forEach(function(message) {
                message.remove();
            });
        }



        var paymentForm = document.getElementById('paymentForm');
        paymentForm.action = '/client/checkout'; // Mettre à jour l'action du formulaire

        paymentForm.innerHTML += '<input type="hidden" name="paymentMethod" value="' + paymentMethod + '">';
        paymentForm.innerHTML += '<input type="hidden" name="phoneNumber" value="' + phoneNumber + '">';
        paymentForm.innerHTML += '<input type="hidden" name="deliveryAddress" value="' + deliveryAddress + '">';
        paymentForm.innerHTML += '<input type="hidden" name="email" value="' + email + '">';

        // Remettre à zéro les styles d'erreur Bootstrap et de validation
        phoneNumberInput.classList.remove('is-invalid');
        deliveryAddressInput.classList.remove('is-invalid');
        emailInput.classList.remove('is-invalid');
        document.querySelectorAll('.invalid-feedback').forEach(function(el) {
            el.remove();
        });

        if (paymentMethod === 'enligne') {
            var cardNumber = document.getElementById('cardNumber');
            var expiryMonth = document.getElementById('expiryMonth');
            var expiryYear = document.getElementById('expiryYear');
            var cvc = document.getElementById('cvc');

            // Vérification des données de la carte uniquement si la méthode de paiement est en ligne
            if (!(/^\d{16}$/.test(cardNumber.value))) {
                cardNumber.classList.add('is-invalid');
                cardNumber.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Veuillez entrer un numéro de carte valide (16 chiffres).</div>');
                return;
            } else {
                cardNumber.classList.remove('is-invalid');
                cardNumber.classList.add('is-valid');
            }

            if (!(/^\d{2}$/.test(expiryMonth.value) && parseInt(expiryMonth.value) >= 1 && parseInt(expiryMonth.value) <= 12)) {
                expiryMonth.classList.add('is-invalid');
                expiryMonth.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Veuillez entrer un mois d\'expiration valide (01 à 12).</div>');
                return;
            } else {
                expiryMonth.classList.remove('is-invalid');
                expiryMonth.classList.add('is-valid');
            }
            var currentYear = new Date().getFullYear(); // Obtient l'année actuelle
            var maxYear = currentYear + 10; // L'année actuelle plus dix ans

            if (!(/^\d{4}$/.test(expiryYear.value)) || expiryYear.value < currentYear || expiryYear.value > maxYear) {
                expiryYear.classList.add('is-invalid');
                expiryYear.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Veuillez entrer une année d\'expiration valide (entre ' + currentYear + ' et ' + maxYear + ').</div>');
                return;
            } else {
                expiryYear.classList.remove('is-invalid');
                expiryYear.classList.add('is-valid');
            }

            if (!(/^\d{3,4}$/.test(cvc.value))) {
                cvc.classList.add('is-invalid');
                cvc.insertAdjacentHTML('afterend', '<div class="invalid-feedback">Veuillez entrer un code CVC valide (3 ou 4 chiffres).</div>');
                return;
            } else {
                cvc.classList.remove('is-invalid');
                cvc.classList.add('is-valid');
            }

            // Ajouter des champs cachés pour les données de paiement
            paymentForm.innerHTML += '<input type="hidden" name="cardNumber" value="' + cardNumber.value + '">';
            paymentForm.innerHTML += '<input type="hidden" name="expiryMonth" value="' + expiryMonth.value + '">';
            paymentForm.innerHTML += '<input type="hidden" name="expiryYear" value="' + expiryYear.value + '">';
            paymentForm.innerHTML += '<input type="hidden" name="cvc" value="' + cvc.value + '">';
        }

        // Soumettre le formulaire de récapitulatif de panier
        paymentForm.submit();
    });
</script>




@foreach ($commande->lignecommandes as $lc)
    @if ($lc->product->qte < $lc->qte && $lc->product->qte > 0)
        <script>
            alert("La quantité demandée dépasse la quantité disponible ({{ $product->qte }}).");
            return false; // Cela doit être ajusté pour fonctionner correctement.
        </script>
    @elseif ($lc->product->qte == 0)
        <script>
            alert("Produit non disponible.");
            return false; // Cela doit être ajusté pour fonctionner correctement.
        </script>
    @elseif ($lc->size != null || $lc->color != null)
        <script>
            var sizeColorData = @json($sizecolors);

            function findQuantityForSelection(size, color) {
                for (var i = 0; i < sizeColorData.length; i++) {
                    if (sizeColorData[i].size === size && sizeColorData[i].color === color) {
                        return sizeColorData[i].qte;
                    }
                }
                return 'N/A';
            }

            function validateQuantity() {
                var selectedSize = document.querySelector("input[name='size']").value;
                var selectedColor = document.querySelector("input[name='color']").value;
                var quantity = findQuantityForSelection(selectedSize, selectedColor);
                var quantityInput = document.querySelector("input[name='qte']");
                var qte = parseInt(quantityInput.value);

                if (quantity === 'N/A') {
                    alert("Article non disponible.");
                    return false;
                }

                if (qte <= 0) {
                    alert("La quantité demandée doit être supérieure à zéro.");
                    return false;
                }

                if (qte > quantity) {
                    alert("La quantité demandée ne peut pas dépasser la quantité disponible (" + quantity + ").");
                    return false;
                }

                return true;
            }
        </script>
    @endif
@endforeach





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
