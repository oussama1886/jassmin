<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contactez Nous-JasminShop</title>
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
    <div class="row align-items-center py-3 px-xl-5">
        <img  src="{{ asset("/dashassets/img/team/jasminshop.png") }}" alt="User-Profile-Image" width="150" height="120">
        <div class="col-lg-3 d-none d-lg-block">

            <a href="http://jasminshop.test" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold">

                    <span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop
                </h1>
            </a>
        </div>

        <div class="col-lg-5 col-3">
            <div class="text-left">
                @auth
                <a href="" class="btn border">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge">
                        {{-- afficher le nom de client --}}
                        @php
                            $clientName = null; // Initialisation du nom du client à null
                        @endphp

                        @foreach(auth()->user()->commandes as $index => $commande)
                            @if(is_null($clientName))
                                <td>{{ $commande->client->name }}</td>
                                @php $clientName = $commande->client->name; @endphp
                            @endif
                        @endforeach
                        @endauth
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Nous contacter</h2>
                <p>Adresse : rue de rose, cité El GHAZALA TUNIS</p>
                <p>Téléphone : 36 360 000</p>
                <p>Email : Livraison@jasminshop.tn</p>
            </div>
            <div class="col-md-6">
                <h2>Google Maps</h2>
                <!-- Inclure la carte Google Maps ici -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3190.861164258226!2d10.184460910456936!3d36.89366947210472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12e2cb71841eca41%3A0x90bf0f4a4360e5fa!2sP%C3%B4le%20Technologique%20El%20Ghazala!5e0!3m2!1sfr!2stn!4v1709674959009!5m2!1sfr!2stn" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2>Laissez-nous un message</h2>
                <form action="" method="">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
