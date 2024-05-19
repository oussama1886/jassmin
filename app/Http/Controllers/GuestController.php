<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\SizeColor;

class GuestController extends Controller
{
    public function home() {
        $produits = Product::where('qte', '>', 0)->paginate(12); // Retrieve all products from the database where quantity > 0
        $categories = Category::all(); // Retrieve all categories from the database
        return view('guest.home', compact('produits', 'categories')); // Pass these data to the 'home' view
    }


    public function productDetails($id) {

        // Récupérer tous les produits de la base de données sauf  produit dont id est...
        $produits = Product::where('id','!=',$id)->get();

        // Récupérer toutes les catégories de la base de données
        $categories = Category::all();

        // Récupérer les détails du produit spécifique en fonction de l'identifiant passé en paramètre
        $product = Product::find($id);

// Récupérer les données de taille et de couleur de la base de données ou du service

        $sizecolors = SizeColor::where('id_product', $id)->get();

        // Tailles uniques et tri personnalisé
        $uniqueSizes = $sizecolors->unique('size');
        $sortedSizes = $uniqueSizes->sortBy(function ($sizecolor) {
            if (is_numeric($sizecolor->size)) {
                return intval($sizecolor->size);
            } else {
                $order = ['S', 'M', 'L', 'XL', 'XXL'];
                return array_search($sizecolor->size, $order);
            }
        });
        $uniquecolor = $sizecolors->unique('color');

        $hasSizes = $sortedSizes->contains(function ($sizecolor) {
            return $sizecolor->size !== 'null';
        });
        $hasColors = $sortedSizes->contains(function ($sizecolor) {
            return $sizecolor->color !== 'null';
        });

        // Retourner la vue avec les données récupérées
        return view('guest.product-details', compact('produits', 'categories', 'product', 'sizecolors', 'hasSizes', 'hasColors', 'sortedSizes','uniquecolor'));

    }

/////////////////////////
public function search(Request $request){
    $categories = Category::all();
    $produits = Product::where('name', 'LIKE', '%' . $request->keywords . '%')->paginate(12);
    return view('guest.shop', compact('categories', 'produits'));
}



public function contact(){
    return view('/guest/contact');
}

public function apropos(){
    return view('/guest/apropos');
}

public function livraison(){
    return view('/guest/livraison');
}


public function affichersize(Request $request){

        // Récupérer les données du formulaire
        $product_id = $request->input('product');
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('qte');

        // Passer les données à la vue
        return view('guest.aff', compact('product_id', 'size', 'color', 'quantity'));
    }


    public function shop($idcategory) {
        $cat = Category::find($idcategory);
        $categories = Category::all();
        $produits = Product::where('category_id', $idcategory)->paginate(12);

        return view('guest.shop', compact('cat', 'categories', 'produits'));
    }



    public function shop1($idcategory) {

        // Récupérer tous les produits de la base de données
        $product = Product::all();

        // Récupérer la catégorie spécifique en fonction de l'identifiant passé en paramètre
        $cat = Category::find($idcategory);

        // Récupérer toutes les catégories de la base de données
        $categories = Category::all();

        // Récupérer toutes les produits de la base de données dont la catégorie est $idcategory
        $produits = Product::where('category_id', $idcategory)->paginate(12);

        // Retourner la vue avec les données récupérées
        return view('guest.shop', compact('cat', 'categories', 'product', 'produits'));
    }



}
