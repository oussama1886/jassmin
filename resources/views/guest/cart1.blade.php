<!DOCTYPE html>
<html lang="en">
   {{--------------------------------  $sessionId = session()->getId(); ------------------------------}}

<head>
    <meta charset="utf-8">
    <title>Jasmin Shop</title>
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
            <div class="col-lg-6 d-none d-lg-block">

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

            <div class="col-lg-3 col-6 text-right">
            </div>
            <div class="col-lg-3 col-6 text-right">
            </div>
                <div class="col-lg-3 col-6 text-right">
         @auth
                <a href="" class="btn border">
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
       @endauth



            </div>
        </div>
    </div>
    <!-- Topbar End -->

 {{--  {{ dd(session('cart', [])) }} --}}

 <!-- Page Header Start -->
 <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">PANIER</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Acceuil</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">PANIER</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

 <div class="row px-xl-5">
    <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-secondary text-dark">
                <tr>

                    <th>Produits</th>
                  {{--   <th> product_id</th> --}}

                    <th>taille</th>
                    <th>couleur</th>
                     <th>Prix</th>
                    <th>Quantité</th>
                    <th>suppression</th>

                    {{--  <th>Total</th>
                    <th>Remove</th> --}}
                </tr>
            </thead>
            <tbody class="align-middle">

                @foreach(session('cart', []) as $item)
                    <tr>
                        <td class="align-middle">
                            @php
                            $product = App\Models\Product::find($item['product_id']);
                            @endphp

                            @if($product)
                                <img src="{{ asset('uploads') }}/{{ $product->photo }}" alt="" style="width: 50px;"> {{ $product->name }}
                            @else
                                Aucune photo disponible
                            @endif
                        </td>
                       {{--   <td> {{ $item['product_id']}}</td> --}}
                        <td class="align-middle">@if ( $item['size'] =='null'||$item['size'] =='')  --  @else {{$item['size']}} @endif </td>
                        <td class="align-middle">@if ( $item['color'] =='null'||$item['color'] =='')  --  @else {{ $item['color'] }} @endif </td>

                       {{--  <td>Taille: {{ $item['size'] }}</td>
                        <td>Couleur: {{ $item['color'] }}</td> --}}
                        <td> {{ $product->price }}</td>
                        <td> {{ $item['qte'] }}</td>
                       {{--  <td> {{ $item['qte'] * $product->price }}</td> --}}
                        <td>
                            <form action="/remove-from-cart" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <button type="submit" class="btn btn-danger btn-sm">supprimer</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tr>
                {{-- <td>Session ID: {{ session()->getId() }}</td> --}}
            </tr>
        </table>
    </div>
</div>
<div>

    @auth

    <div class="col p-3 text-center text-white d-flex align-items-center justify-content-center">
        <i class="text-primary"></i>
        <span class="badge">
            @if(auth()->user())
            <form action="/client/order/store1" method="POST" id="order-form">
                @csrf
                @foreach(session('cart', []) as $item)
                <input type="hidden" name="products[{{ $loop->index }}][product_id]" value="{{ $item['product_id'] }}">
                <input type="hidden" name="products[{{ $loop->index }}][size]" value="{{ $item['size'] }}">
                <input type="hidden" name="products[{{ $loop->index }}][color]" value="{{ $item['color'] }}">
                <input type="hidden" name="products[{{ $loop->index }}][qte]" value="{{ $item['qte'] }}">
                @endforeach
                <input type="hidden" value="{{ Auth::user()->id }}" name="client_id">
                <button type="submit" class="btn btn-block btn-primary my-3 py-3">voir le montant globale</button>
            </form>
            @endif
        </span>
    </div>

 @else
 <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="login-button text-center">
            <a href="/login" class="btn btn-block btn-primary my-3 py-3">Connectez ici pour finir votre commande</a>
        </div>
    </div>
</div>


    @endif










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
