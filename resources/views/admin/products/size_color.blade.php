
{{-- @include('inc.admin.nav') --}}
@extends('layouts.app')

@section('content')
<script>
    function validateForm() {
        var size = document.getElementById('size').value;
        var color = document.getElementById('color').value;

        if (size === '' && color === '') {
            alert('Veuillez saisir une taille ou une couleur.');
            return false; // Empêcher l'envoi du formulaire
        }
        return true; // Autoriser l'envoi du formulaire si une taille ou une couleur est saisie
    }
</script>
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('availableQuantity'))
<div class="alert alert-danger">
    La quantité demandée dépasse la quantité totale disponible pour ce produit. Quantité totale disponible : {{ session('availableQuantity') }}
</div>
@endif
<div class="container">

<!-- Utilisation des détails du produit dans la vue -->
<div style="display: flex; align-items: center;">
    <img src="{{ asset('uploads') }}/{{$product->photo }}" width="150" alt="">
    <div style="margin-left: 20px;"> <!-- Espacement entre l'image et le texte -->
        <h2>Détails du produit</h2>
        <p>Nom: {{ $product->name }}</p>
        <p>ID produit: {{ $product->id }}</p>
        <p>Quantité totale de produit: {{ $product->qte}}</p>
    </div>
     <!-- Bouton pour ouvrir le modal d'ajout -->
  <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addSizeColorModal">
    Ajouter une taille/couleur
</button>
</div>




    <!-- Modal d'ajout de taille et couleur -->
    <div class="modal fade" id="addSizeColorModal" tabindex="-1" aria-labelledby="addSizeColorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeColorModalLabel">Ajouter une taille et une couleur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire pour ajouter une taille et une couleur -->
                    <form action="/admin/product/silor" method="POST" onsubmit="return validateForm()">

                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="productQuantity" class="form-label">Quantité du produit</label>
                            <input type="number" class="form-control" id="productQuantity" name="qte"
                                placeholder="Entrez la quantité du produit" min="0" required>
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if(session('availableQuantity'))
                                <div class="alert alert-danger">
                                    La quantité demandée dépasse la quantité totale disponible pour ce produit. Quantité totale disponible : {{ session('availableQuantity') }}
                                </div>
                            @endif


                        </div>
                        <div class="mb-3">
                            <label for="size" class="form-label">Taille</label>
                            <select name="size" id="size" class="form-control">
                                <option value="" selected>--</option> <!-- Option null sélectionnée par défaut -->
                                <optgroup label="Tailles internationales (S à XXL)">
                                    <!-- Options pour les tailles internationales -->
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </optgroup>
                                <optgroup label="Tailles européennes (EU 34 à 60)">
                                    <!-- Options pour les tailles européennes -->
                                    <option value="34">34</option>
                                    <option value="36">36</option>
                                    <option value="38">38</option>
                                    <option value="40">40</option>
                                    <option value="42">42</option>
                                    <option value="44">44</option>
                                    <option value="46">46</option>
                                    <option value="48">48</option>
                                    <option value="50">50</option>
                                    <option value="52">52</option>
                                    <option value="54">54</option>
                                    <option value="56">56</option>
                                    <option value="58">58</option>
                                    <option value="60">60</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Couleur</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="Entrez la couleur">
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



    <!-- modal update -->

@foreach($sizesColors as $sizeColor)
@if($sizeColor->id_product == $product->id)
    <!-- Modal de modification -->
    <div class="modal fade" id="editSizeColorModal{{ $sizeColor->id }}" tabindex="-1" aria-labelledby="editSizeColorModalLabel{{ $sizeColor->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSizeColorModalLabel{{ $sizeColor->id }}">Modifier la taille et la couleur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.updateSizeColor', ['id' => $sizeColor->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Champs pour la modification de la taille et de la couleur -->
                        <div class="mb-3">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="editColor{{ $sizeColor->id }}" class="form-label">quantité</label>
                            <input type="number" id="editColor{{ $sizeColor->id }}" name="qte" class="form-control" value="{{ $sizeColor->qte }}" min="0" required>
                        </div>

                            <div class="mb-3">
                                <label for="size" class="form-label">Taille</label>
                                <select name="size" id="size" class="form-control">
                                    <option value="" selected>{{ $sizeColor->size }}</option> <!-- Option null sélectionnée par défaut -->
                                    <optgroup label="Tailles internationales (S à XXL)">
                                        <!-- Options pour les tailles internationales -->
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </optgroup>
                                    <optgroup label="Tailles européennes (EU 34 à 60)">
                                        <!-- Options pour les tailles européennes -->
                                        <option value="34">34</option>
                                        <option value="36">36</option>
                                        <option value="38">38</option>
                                        <option value="40">40</option>
                                        <option value="42">42</option>
                                        <option value="44">44</option>
                                        <option value="46">46</option>
                                        <option value="48">48</option>
                                        <option value="50">50</option>
                                        <option value="52">52</option>
                                        <option value="54">54</option>
                                        <option value="56">56</option>
                                        <option value="58">58</option>
                                        <option value="60">60</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editColor{{ $sizeColor->id }}" class="form-label">Couleur</label>
                            <input type="text" id="editColor{{ $sizeColor->id }}" name="color" class="form-control" value="{{ $sizeColor->color }}" required>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach

   <!-- Affichage des tailles et couleurs saisies -->
<div class="container mt-4">
    <h3>Liste des tailles et couleurs: </h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID_produit</th>
                <th scope="col">quantité</th>
                <th scope="col">Taille</th>
                <th scope="col">Couleur</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher les tailles et couleurs -->
            @php $index = 1; @endphp
            @foreach($sizesColors as $sizeColor)
                @if($sizeColor->id_product == $product->id)
                <tr>
                    <td scope="row">{{ $index++ }}</td>
                    <td>{{ $sizeColor->id_product }}</td> <!-- Afficher l'ID du produit -->
                    <td>{{ $sizeColor->qte }}</td>
                    <td>{{ $sizeColor->size }}</td>
                    <td>{{ $sizeColor->color }}</td>
                    <td>
                        <!-- Bouton pour ouvrir le modal de modification -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSizeColorModal{{ $sizeColor->id }}" data-size="{{ $sizeColor->size }}" data-color="{{ $sizeColor->color }}" data-id="{{ $sizeColor->id }}">
                            Modifier
                        </button>

                        <!-- Bouton pour supprimer la taille/couleur -->
                        <a onclick="return confirm('Voulez-vous supprimer cette ligne: {{ $index-1 }}')" href="/admin/product/{{ $sizeColor->id }}/destroysize" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>

                @endif
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection
