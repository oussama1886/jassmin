<script>
 @foreach ($commande->lignecommandes as $lc)
if({{ $product->qte }}< {{ $lc->qte }} && {{ $product->qte }}>0) {
            alert("La quantité demandée  dépasse la quantité disponible (" +$product->qte + ").");
            return false; // Empêche le formulaire de se soumettre
        }
elseif ({{ $product->qte }}==0) {
            alert("produit non disponible .");
            return false; // Empêche le formulaire de se soumettre
        }
elseif({{ $lc->size }}!=null || {{ $lc->color }}!=null){
     // Récupérer les données de taille et de couleur de la base de données depuis PHP
    var sizeColorData = @json($sizecolors);

    // Fonction pour trouver la quantité pour la taille et la couleur sélectionnées
    function findQuantityForSelection(size, color) {
        for (var i = 0; i < sizeColorData.length; i++) {
            if (sizeColorData[i].size === size && sizeColorData[i].color === color) {
                return sizeColorData[i].qte;
            }
        }
        return 'N/A'; // Non disponible si la combinaison n'est pas trouvée
    }

    // Fonction pour valider la quantité demandée
    function validateQuantity() {
        // Récupérez la taille et la couleur à partir des champs cachés
        var selectedSize = document.querySelector({{ $lc->size }}).value;
        var selectedColor = document.querySelector({{ $lc->color }}).value;

        // Trouvez la quantité disponible pour la sélection de taille et de couleur
        var quantity = findQuantityForSelection(selectedSize, selectedColor);

        // Récupérez la quantité saisie par l'utilisateur
        var quantityInput = document.querySelector({{ $lc->qte }});
        var qte = parseInt(quantityInput.value);

        // Vérifiez si la quantité disponible est connue (non "N/A")
        if (quantity === 'N/A') {
            alert("Article non disponible.");
            return false; // Empêche le formulaire de se soumettre
        }



        // Vérifiez si la quantité demandée dépasse la quantité disponible
        if (qte > quantity) {
            alert("La quantité demandée ne peut pas dépasser la quantité disponible (" + quantity + ").");
            return false; // Empêche le formulaire de se soumettre
        }

        // Si toutes les vérifications sont réussies, permettez au formulaire de se soumettre
        return true;
    }
}

@endforeach

</script>
