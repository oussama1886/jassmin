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

        @include('inc.admin.sidebar')


        @include('inc.admin.nav')



        <style>
            /* Custom CSS for centering the form */
            .centered-form {
                margin-left: auto;
                margin-right: auto;
                width: 50%; /* Adjust the width of the form as needed */
            }

            /* Custom CSS for adjusting input field width */
            .form-control {
                width: 250px; /* Set the desired width for the input fields */
            }
        </style>

        <div class="content">
            <div class="pb-5">
                <div class="row g-5"></div>
                <form action="/admin/Profile/update" method="POST" class="centered-form">
                    @csrf
                    <h2 class="mt-2">Admin Edit Profil</h2>
                    <!-- afficher les modification avec succes-->
                    @if (session('success'))
                    <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                        <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                        <p class="mb-0 flex-1">{{ session('success') }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- afficher les erreur-->
                    @if ($errors->any())
                    <div class="alert alert-soft-warning alert-dismissible fade show" style="color: red; font-weight: bold;">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <br></br>
                    {{-- <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="form-control" name="name" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="form-control" name="email" required>
                    </div>
                    <br></br>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="new password" required>
                    </div>
                    <br></br>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"placeholder="confirm new password" required>
                    </div>
                    <br></br>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>




          <footer class="footer">

          </footer>
        </div>
      </div>
    </main>
    <script src="{{asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js')}}"></script>
  </body>

</html>
