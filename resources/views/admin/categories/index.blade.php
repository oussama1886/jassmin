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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
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


            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <h1> liste de categorie </h1>

                        <hr />

                        <div class="div">
                            <div class="row">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-3">ajouter categorie</a>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>
                        </div>




                        <div class="mt-3">
                            <table class="table table-bordered border-primary" style="background-color: #e6ecf1;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" _msttexthash="95160" _msthash="329">Nom categorie</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Description categorie
                                        </th>
                                        <th scope="col" _msttexthash="73463" _msthash="331">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $c)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->description }}</td>
                                            <td>

                                                <a data-bs-toggle="modal" data-bs-target="#updateModal" data-id={{$c->id}} class="btn btn-success">Modifier</a>
                                                <a onclick="return confirm('voulez vous supprimer cette categorie: {{ $c->name }}')"
                                                    href="/admin/categories/{{ $c->id }}/delete"
                                                    class="btn btn-danger">Supprimer</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
            </div>



            <footer class="footer">
                <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">v1.1.0</p>
                    </div>
                </div>
            </footer>
        </div>
        </div>
    </main>
    <!-- modal ajouter -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" _mstvisible="0"

        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" _mstvisible="1">
            <div class="modal-content" _mstvisible="2">
                <div class="modal-header" _mstvisible="3">
                    <h5 class="modal-title" id="exampleModalLabel" _msttexthash="156741" _msthash="142"
                        _mstvisible="4">Ajouter categorie</h5><button class="btn p-1" type="button"
                        data-bs-dismiss="modal" aria-label="Fermer" _mstaria-label="59709" _msthash="143"
                        _mstvisible="4"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="times" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""
                            _mstVisible="5">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                _mstVisible="6"></path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                </div>
                <form action="/admin/categories/store" method="post">
                    @csrf
                    <div class="modal-body" _mstvisible="3">


                        <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">nom categorie</label>
                            <input name = "name" class="form-control" id="exampleFormControlInput1" type="text"
                                placeholder="nom categorie" >

                            @error('name')
                                <div class = "alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror



                        </div>
                        <div class="mb-0"><label class="form-label" for="exampleTextarea">description categorie</label>
                            <textarea name ="description" class="form-control" rows="3"> </textarea>


                            @error('description')
                                <div class = "alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>




                        <p class="text-700 lh-lg mb-0" _msttexthash="38825592" _msthash="144" _mstvisible="4">Il
                            le corps modal (requis pour le remplissage) et le
                            pied de page modal (facultatif).</p>
                    </div>
                    <div class="modal-footer" _mstvisible="3"><button class="btn btn-primary" type="submit"
                            _msttexthash="953914" _msthash="145" _mstvisible="4">D’accord</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal"
                            _msttexthash="95901" _msthash="146" _mstvisible="4">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal de modification -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" _mstvisible="0"

        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" _mstvisible="1">
            <div class="modal-content" _mstvisible="2">
                <div class="modal-header" _mstvisible="3">
                    <h5 class="modal-title" id="exampleModalLabel" _msttexthash="156741" _msthash="142"
                        _mstvisible="4">Modifier categorie</h5><button class="btn p-1" type="button"
                        data-bs-dismiss="modal" aria-label="Fermer" _mstaria-label="59709" _msthash="143"
                        _mstvisible="4"><svg class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="times" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""
                            _mstVisible="5">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                _mstVisible="6"></path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>
                </div>
                <form action="/admin/categories/update" method="post">
                    @csrf
                    <div class="modal-body" _mstvisible="3">


                        <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">nom
                                categorie</label>
                            <input name = "id" id="update_id" type="hidden">


                            <input name = "name" id="update_name" class="form-control" id="exampleFormControlInput1" type="text"
                                placeholder="nom categorie">

                            @error('name')
                                <div class = "alert alert-danger">
                                    {{ message }}
                                </div>
                            @enderror



                        </div>
                        <div class="mb-0"><label class="form-label" for="exampleTextarea">description
                                categorie</label>
                            <textarea id="update_description" name ="description" class="form-control" rows="3"> </textarea>


                            @error('description')
                                <div class = "alert alert-danger">
                                    {{ message }}
                                </div>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer" _mstvisible="3"><button class="btn btn-primary" type="submit"
                            _msttexthash="953914" _msthash="145" _mstvisible="4">D’accord</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal"
                            _msttexthash="95901" _msthash="146" _mstvisible="4">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div-->


    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var data = @json($categories);
            $(document).on('show.bs.modal', '#updateModal', function(event) {
                var triggerLink = $(event.relatedTarget);
                var id = triggerLink.data('id');
                cat=data.find(function(category) {
                    return category.id === id;
                });
                $('#update_id').val(cat['id'])
                $('#update_name').val(cat['name'])
                $('#update_description').val(cat['description'])
            });
        })

    </script>
</body>

</html>
