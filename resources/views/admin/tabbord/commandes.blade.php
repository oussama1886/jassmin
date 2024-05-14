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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<style>
    body {
        opacity: 0;
    }
</style>

<main class="main" id="top">
    <div class="container-fluid px-0">

        @include('inc.admin.sidebar')


        @include('inc.admin.nav')


        <div class="container">


        </div>
    </main>
    <div class="col-lg-8 col-md-8 col-sm-4 mb-2 mx-auto text-center">
    <h1>Tableau de bord</h1>

    <div>
        <h2>Nombre de commandes payées : {{ $data['paye'] }}</h2>
        <h2>Nombre de commandes en cours : {{ $data['en_cours'] }}</h2>
    </div>
</div>
    <main class="main" id="top">
        <div class="col-lg-4 col-md-8 col-sm-4 mb-2 mx-auto text-center">
            <!-- Sidebar and navigation included -->
            <canvas id="myChart"></canvas> <!-- Canvas for Chart.js -->

        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Ajout du plugin -->

    <script>
        // Fixed values for Chart.js
        const labels = ['commande paye', 'commande en cours'];
        const datasets = [{
            label: 'Sales',
            data: [{{ $data['paye'] }}, {{ $data['en_cours'] }}], // Sample data
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ],
            hoverOffset: 4
        }];

        const data = {
            labels: labels,
            datasets: datasets
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            return value; // Afficher la valeur numérique
                        }
                    }
                }
            }
        };

        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, config);
    </script>


    <script src="{{asset('dashassets/js/phoenix.js')}}"></script>
    <script src="{{asset('dashassets/js/ecommerce-dashboard.js')}}"></script>

    </body>
    </html>
