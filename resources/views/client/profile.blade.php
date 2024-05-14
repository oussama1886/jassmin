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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset ('dashassets/css/phoenix.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset ('dashassets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <div class="container-fluid px-0">
            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                    </div>
                    <form action="/client/Profile/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="mt-2">Client Edit Profil</h2>
                        <!-- Afficher les modifications avec succès -->
                        @if (session('success'))
                        <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                            <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- Afficher les erreurs -->
                        @if ($errors->any())
                        <div class="alert alert-soft-warning alert-dismissible fade show" style="color: red; font-weight: bold;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(!empty(auth()->user()->photo))
                        <img class="rounded-circle" src="{{ asset('dashassets/img/client/'. auth()->user()->photo) }}" alt="User-Profile-Image" width="180" height="180">
                        @else
                        <!-- Photo standard -->
                        <img class="rounded-circle" src="{{ asset('dashassets/img/client/profile.png') }}" alt="User-Profile-Image" width="180" height="180">
                        @endif
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" value="{{ auth()->user()->name }}" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="adress">adress</label>
                            <input type="text" value="{{ auth()->user()->adress }}" class="form-control" id="adress" name="adress" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" value="{{ auth()->user()->phone }}" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>


                    <form action="/client/Profile/updat-password" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="mt-2">modifier mot de passe</h2>
                        <!-- Afficher les modifications avec succès -->
                        @if (session('success'))
                        <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                            <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- Afficher les erreurs -->
                        @if ($errors->any())
                        <div class="alert alert-soft-warning alert-dismissible fade show" style="color: red; font-weight: bold;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="New password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="footer">
                <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                    <div class="col-12 col-sm-auto text-center">

                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">v1.1.0</p>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js')}}"></script>
</body>

</html>
