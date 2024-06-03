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
            <!-- Include sidebar and navigation -->
            @include('inc.admin.sidebar')
            @include('inc.admin.nav')

            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <h1> Liste de produits</h1>
                        <hr />
                        <!-- Bouton pour ouvrir la modal d'ajout de produit -->
                        <div class="row justify-content-center">
                        <!-- recherche de produit par nom et qte -->
                        <div class="mt-2">
                            <form action="/admin/product/search" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="product_name" placeholder="Tapez un nom de produit">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" name="qte" placeholder="Tapez le quantité de produit maximum" min="0">
                                    </div>

                                    <div class="col-2">
                                        <button class="btn btn-success" type="submit">Rechercher</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-4">
                        <div class="mt-4">

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Ajouter produit</button>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" _msttexthash="95160" _msthash="329">ID produit</th>
                                        <th scope="col" _msttexthash="95160" _msthash="329">Nom produit</th>
                                        <th scope="col" _msttexthash="95160" _msthash="329">details produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Description produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Prix produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Prix d'achat produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Ancien Prix produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Quantité produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Image principale produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Image 1 produit</th>
                                        <th scope="col" _msttexthash="94367" _msthash="330">Image 2 produit</th>
                                        <th scope="col" _msttexthash="73463" _msthash="331" class="text-center"> <td class="text-center">Actions</td></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $p)
                                    <tr>
                                        <th scope="row">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</th>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->details }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td>{{ $p->price }}</td>
                                        <td>{{ $p->purchase_price }}</td>
                                        <td>{{ $p->old_price }}</td>
                                        <td>{{ $p->qte }}</td>
                                        <!-- asset == acces au dossier public et puis le dossier uploads puis le l'image sous le nom : $p->photo -->
                                        <td><img src="{{ asset('uploads') }}/{{ $p->photo }}" width="80" alt=""></td>

                                            <td><img src="{{ asset('uploads') }}/{{ $p->imag_one }}" width="80" alt=""></td>

                                                <td><img src="{{ asset('uploads') }}/{{ $p->imag_two }}" width="80" alt=""></td>
                                                <td>
                                                    <td class="text-center">
                                                       {{--  <div class="row justify-content-center"> --}}
                                                            <div class="col-9">
                                                            <a data-bs-toggle="modal" data-bs-target="#updateModal" data-id="{{ $p->id }}" class="btn btn-success btn-sm btn-block">Modifier</a>
                                                        </div>
                                                        <div class="col-6">
                                                            @if ($p->archived)
                                                            <a onclick="return confirm('Voulez-vous désarchiver ce produit: {{ $p->name }}')"
                                                               href="/admin/product/{{ $p->id }}/unarchive" class="btn btn-warning btn-sm btn-block">Désarchiver</a>
                                                        @else
                                                            <a onclick="return confirm('Voulez-vous archiver ce produit: {{ $p->name }}')"
                                                               href="/admin/product/{{ $p->id }}/archive" class="btn btn-warning btn-sm btn-block">Archiver</a>
                                                        @endif
                                                        </div>
                                                        <div class="col-9">
                                                            <a onclick="return confirm('Voulez-vous supprimer cet produit: {{ $p->name }}')" href="/admin/product/{{ $p->id }}/delete" class="btn btn-danger btn-sm btn-block">Supprimer</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{ route('sizeColor', ['product_id' => $p->id]) }}" class="btn btn-primary btn-sm btn-block">Size/Color</a>
                                                        </div>
                                                 {{--    </div> --}}

                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-center">

                                        {{ $products->appends(request()->input())->links('pagination::bootstrap-5', ['class' => 'pagination-sm']) }}
                                    </div>
                                </div>
                            </table>

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
    </main>
    <!-- Modal d'ajout de produit -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/product/store" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $p->id }}">

                    <div class="mb-3">
                        <label for="updatecat" class="form-label">Categorie du produit</label>
                        <select name="categorie" class="form-control">
                           @foreach ($categories as $c)
                           <option value="{{ $c->id }}">{{ $c->name }}</option>
                           @endforeach


                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" id="productName" name="name"
                                placeholder="Entrez le nom du produit" required>
                                @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Details technique du produit</label>
                            <textarea class="form-control" id="productDetails" name="details" rows="3"
                                placeholder="Entrez la details technique du produit" required></textarea>
                            @error('details')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description du produit</label>
                            <textarea class="form-control" id="productDescription" name="description" rows="3"
                                placeholder="Entrez la description du produit" required></textarea>
                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Prix de vente produit</label>
                            <input type="number" class="form-control" id="productPrice" name="price"
                                placeholder="Entrez le prix du produit" required>
                                @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Prix d'achat produit</label>
                            <input type="number" class="form-control" id="productPrice" name="purchase_price"
                                placeholder="Entrez le prix d'achat produit" required>
                                @error('purchase_price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Ancien prix produit</label>
                            <input type="number" class="form-control" id="oldPrice" name="old_price"
                                placeholder="Entrez l'ancien prix du produit" required>
                                @error('old_price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Quantité du produit</label>
                            <input type="number" class="form-control" id="productQuantity" name="qte"
                                placeholder="Entrez la quantité du produit" required>
                                @error('qte')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productimage" class="form-label">image du produit</label>
                            <input type="file" class="form-control" id="productimage" name="photo"
                                placeholder="choisir l'image pricipale du produit" required>
                                @error('photo')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="productimage" class="form-label">image 1 du produit</label>
                            <input type="file" class="form-control" id="imag_one" name="imag_one"
                                placeholder="choisir l'image pricipale du produit" required>
                                @error('imag_one')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>


                        <div class="mb-3">
                            <label for="productimage" class="form-label">image 2 du produit</label>
                            <input type="file" class="form-control" id="imag_two" name="imag_two"
                                placeholder="choisir l'image pricipale du produit" required>
                                @error('imag_two')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        <div class="modal-footer">



                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Modal d'update de produit -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Modifier produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/product/update" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input name="id" id="update_id" type="hidden">

                    <div class="mb-3">
                        <img src="" id="update_product_image_display" width="80" alt="Image du produit">
                        <img src="" id="update_image_one_display" width="80" alt="Image 1 du produit">
                        <img src="" id="update_image_two_display" width="80" alt="Image 2 du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_name" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" id="update_name" name="name" placeholder="Nom du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_details" class="form-label">Détails technique du produit</label>
                        <textarea class="form-control" id="update_details" name="details" placeholder="Entrez les détails techniques du produit" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="update_description" class="form-label">Description du produit</label>
                        <textarea class="form-control" id="update_description" name="description" placeholder="Description du produit"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="update_price" class="form-label">Prix du produit</label>
                        <input type="number" class="form-control" id="update_price" name="price" placeholder="Prix du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_purchase_price" class="form-label">Prix d'achat du produit</label>
                        <input type="number" class="form-control" id="update_purchase_price" name="purchase_price" placeholder="Prix d'achat du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_old_price" class="form-label">Ancien prix du produit</label>
                        <input type="number" class="form-control" id="update_old_price" name="old_price" placeholder="Modifier l'ancien prix du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_qte" class="form-label">Quantité du produit</label>
                        <input type="number" class="form-control" id="update_qte" name="qte" placeholder="Quantité du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_photo" class="form-label">Modifier l'image du produit</label>
                        <input type="file" class="form-control" id="update_photo" name="photo" placeholder="Choisir l'image du produit">
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_imag_one" class="form-label">Modifier l'image 1 du produit</label>
                        <input type="file" class="form-control" id="update_imag_one" name="imag_one" placeholder="Modifier l'image 1 du produit">
                    </div>

                    <div class="mb-3">
                        <label for="update_imag_two" class="form-label">Modifier l'image 2 du produit</label>
                        <input type="file" class="form-control" id="update_imag_two" name="imag_two" placeholder="Modifier l'image 2 du produit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">D’accord</button>
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
<script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var data = @json($products);

        $(document).on('show.bs.modal', '#updateModal', function(event) {
            var triggerLink = $(event.relatedTarget);
            var id = triggerLink.data('id');

            var dataArray = Array.from(data.data);
            var product = dataArray.find(function(p) {
                return p.id === id;
            });

            $('#update_id').val(product.id);
            $('#update_name').val(product.name);
            $('#update_details').val(product.details);
            $('#update_description').val(product.description);
            $('#update_price').val(product.price);
            $('#update_purchase_price').val(product.purchase_price);
            $('#update_old_price').val(product.old_price);
            $('#update_qte').val(product.qte);
            $('#update_product_image_display').attr('src', '{{ asset('uploads') }}/' + product.photo);
            $('#update_image_one_display').attr('src', '{{ asset('uploads') }}/' + product.imag_one);
            $('#update_image_two_display').attr('src', '{{ asset('uploads') }}/' + product.imag_two);
        });
    });
    </script>


</body>

</html>






