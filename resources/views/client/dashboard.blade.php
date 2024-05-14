<!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jasmin Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

    </style>
  </head>

  <body>
    <main class="main" id="top">
      <div class="container-fluid px-0">




        @include('inc.client.nav')





        <div class="content">
          <div class="pb-5">
            <div class="row g-5">


              </div>


            </div>
            <div class="col-lg-3 d-none d-lg-block">
                <a href="http://jasminshop.test" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border px-3 mr-1" style="color: #DDBDD5;">Jasmin</span>
                        <span style="color: #707070;">Shop</span>
                    </h1>
                </a>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
         <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
          <div class="col-sm-4 bg-c-lite-green user-profile">
        <div class="card-block text-center text-white">
            <div class="col-sm-0">
       <div class="m-b-25">
    </div>


    <style>
    .text-primary {
        color: #DDBDD5 !important; /* Cette couleur correspond au rose pâle du logo */
    }

    .display-5 {
        font-family: 'VotrePolice', sans-serif; /* Remplacez 'VotrePolice' par le nom de la police que vous souhaitez utiliser */
    }

    /* Vous pouvez également ajouter un lien vers la police que vous voulez utiliser dans le <head> de votre document HTML */
    @import url('https://fonts.googleapis.com/css2?family=VotrePolice:wght@400;700&display=swap');
    </style>

    @if(!empty(auth()->user()->photo))
    <img class="rounded-circle" src="{{ asset('dashassets/img/client/'. auth()->user()->photo) }}" alt="User-Profile-Image" width="180" height="180">
    @else
    <!-- Photo standard -->
    <img class="rounded-circle" src="{{ asset('dashassets/img/client/profile.png') }}" alt="User-Profile-Image" width="180" height="180">
    @endif


        </form>

        <style>
            /* Style pour le bouton de téléchargement personnalisé */
            .custom-file-upload {
                cursor: pointer;
                background-color: #007bff;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                border: none;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            /* Style pour le bouton de téléchargement personnalisé au survol */
            .custom-file-upload:hover {
                background-color: #0056b3;
            }
        </style>


<ul class="nav d-flex flex-column mb-2 pb-1">
    <!-- Profile Button -->
    <li class="nav-item">
        <form action="/client/profile" method="get">
            <button type="submit" class="nav-link px-3" style="background: none; border: none; cursor: pointer;">
                <span class="me-2 text-900" data-feather="user"></span> modifier Profile
            </button>
        </form>
    </li>

</ul>


 <p></p>
{{-- <a data-bs-toggle="modal" data-bs-target="#editProfileModal" data-id="{{ auth()->user()->id }}" class="btn btn-success">Modifier profil</a> --}}
             </div>
             <div class="col-sm-0">

             <h3 class="f-w-600"> {{ auth()->user()->name }}</h3>
<p></p>

            <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
             </div>
         </div>

           <div class="card-block">
             <h4 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h4>
             <p></p>
             <div class="row">
           <div class="col-sm-0">
            <p></p>
             <p class="m-b-10 f-w-600">Email</p>
             <h4 class="text-muted f-w-400"> {{ auth()->user()->email }}</h4>
            </div>
                <div class="col-sm-0">
                  <p></p>
          <p class="m-b-10 f-w-600">Phone</p>
          <p></p>
          <h4 class="text-muted f-w-400">{{ auth()->user()->phone }}</h4>
             </div>
           </div>

            <div class="row">
              <div class="col-sm-12">
                <p></p>
              <p class="m-b-10 f-w-600">Adress</p>
               <h4 class="text-muted f-w-400">{{ auth()->user()->adress }}</h4>
                  </div>

                   </div>

                         <div class="card-footer ">
                            <hr>
                            <div class="px-3">
                                <!-- Logout Button -->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-phoenix-secondary d-flex flex-center w-100">
                                        <span class="me-2" data-feather="log-out"></span> Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
               </div>
              </div>
             </div>
           </div>

         </div>
       </div>
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
