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

    </div>



<div class="content">
    <div class="pb-5">
        <h1> Détails de la commande </h1>
        <hr />

        <div class="mt-3">
            <table class="table table-bordered border-primary custom-table">
                <!-- Table header -->
                <thead class="thead-light text-center">
                    <tr>
                        <th scope="col">n</th>

                        <th scope="col">Quantité</th>
                        <th scope="col">Produit</th>

                        <th scope="col">Prix</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                     @if (session()->has('commandeData'))
                    @php
                        $commandeData = session('commandeData');
                    @endphp
                     @foreach ($commandeData['lignecommandes'] as $lc)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- & --}}
                        <td>{{ $lc['qte'] }}</td>
                        <td>{{ $lc['product_name'] }} @if($lc['size'])   taille : {{ $lc['size'] }} @endif @if($lc['color']) couleur : {{ $lc['color'] }} @endif</td>


                       {{-- <td><img src="{{ asset('uploads') }}/{{ $lc->product->photo }}"></td> --}}

                        <td>{{ $lc['product_price'] }} TND</td>
                    </tr>
                    @endforeach
                    @else
                    <p>An error occurred. Please try again.</p>
                @endif
                </tbody>


                    @if (session()->has('commandeData'))
                    @php
                        $commandeData = session('commandeData');
                    @endphp




                    <ul>
                        <li>commande numéro: {{ $commandeData['id'] }}</li>
                        <li>État: {{ $commandeData['etat'] }}</li>


                    </ul>
                @else
                    <p>An error occurred. Please try again.</p>
                @endif

                {{-- sa marrrrrrrrrrrrrrrche
                    @if (session()->has('commandeData'))
                    @php
                        $commandeData = session('commandeData');
                    @endphp


                    <h1>Commande Détails</h1>

                    <ul>
                        <li>ID: {{ $commandeData['id'] }}</li>
                        <li>État: {{ $commandeData['etat'] }}</li>
                        <li>Lignes de commande:</li>
                        <ul>
                            @foreach ($commandeData['lignecommandes'] as $lc)
                                <li>
                                    Produit: {{ $lc['product_name'] }} ({{ $lc['size'] }}, {{ $lc['color'] }})
                                    - Quantité: {{ $lc['qte'] }}
                                    - Prix unitaire: {{ $lc['product_price'] }}TND
                                </li>
                            @endforeach
                        </ul>
                    </ul>
                @else
                    <p>An error occurred. Please try again.</p>
                @endif --}}
            </table>
        </div>
    </div>
</div>




</body>

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
