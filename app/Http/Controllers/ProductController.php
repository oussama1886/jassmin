<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\SizeColor;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    //fonction index pour afficher la liste de produit
    public function index()
    {
        $produits = Product::where('qte', '>', 0)->paginate(12); // Retrieve all products from the database where quantity > 0
        $categories = Category::all(); // Retrieve all categories from the database
        return view('guest.home', compact('produits', 'categories')); // Pass these data to the 'home' view
    }
    //fonction index pour afficher la liste de produit
    public function index1()
    {
        // Retrieve all products from the database
        $products = Product::paginate(10);
        $categories= Category::all();
        // Pass the products data to the index view
      return view('admin.products.index', compact('products', 'categories'));


    }



    public function store(Request $request)
    {
        $produit = new Product();

        $produit->name = $request->name;
        $produit->category_id = $request->categorie;
        $produit->description = $request->description;
        $produit->price = $request->price;
        $produit->details = $request->details;
        $produit->purchase_price = $request->purchase_price;
        $produit->old_price = $request->old_price;
        $produit->qte = $request->qte;
        //craetion de dossier pour mettre les  photos qui sappelle uploads et $destinationPath est une variable
        //deplacer les image dans le dossier uploads et l'image a un nom different de nom original
        // Upload de l'image principale
        $image = $request->file('photo');
        $newname = uniqid() . "." . $image->getClientOriginalExtension();
        $distinationPath = 'uploads';
        $image->move($distinationPath, $newname);
        $produit->photo = $newname;

        // Upload de l'image 1
        if ($request->hasFile('imag_one')) {
            $imageOne = $request->file('imag_one');
            $newnameOne = uniqid() . "." . $imageOne->getClientOriginalExtension();
            $imageOne->move($distinationPath, $newnameOne);
            $produit->imag_one = $newnameOne;
        }

        // Upload de l'image 2
        if ($request->hasFile('imag_two')) {
            $imageTwo = $request->file('imag_two');
            $newnameTwo = uniqid() . "." . $imageTwo->getClientOriginalExtension();
            $imageTwo->move($distinationPath, $newnameTwo);
            $produit->imag_two = $newnameTwo;
        }

        // Sauvegarde du produit
        if ($produit->save()) {
            return redirect()->back();
        } else {
            echo "erreur";
        }
    }

    public function destroysize($id){
        $size = SizeColor::find($id);
        if ( $size) {
            // Delete the category
            $size->delete();
            return redirect()->back()->with('success', 'product deleted successfully');
        }
        else {
            // Category not found
            return redirect()->back()->with('error', 'product not found');
        }
    }


    public function destroy($id)
    {
        // Find the category with the given ID
        $produit = Product::find($id);

        // $file_path variable qui contient le chemin de la photos real qui doit etre aussi efface de la dossier qui le contient 'uploads'
        $file_path = public_path().'/uploads/'.$produit->photo;
        // Check if the category exists
        if ($produit) {
            // Delete the category
            $produit->delete();

            //supprimer la photo du dossier avec la fonction unlink
            unlink($file_path);

            // Redirect back after deletion
            return redirect()->back()->with('success', 'product deleted successfully');
        } else {
            // Category not found
            return redirect()->back()->with('error', 'product not found');
        }
    }
    public function update(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'details' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'old_price' => 'required|numeric',
            'qte' => 'required|integer',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'imag_one' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'imag_two' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Récupérer le produit à mettre à jour
        $product = Product::find($request->id);

        // Vérifier si le produit existe
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Mettre à jour les autres champs du produit
        $product->name = $request->name;
        $product->details = $request->details;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->purchase_price = $request->purchase_price;
        $product->qte = $request->qte;
        $product->old_price = $request->old_price;

        // Mettre à jour la photo du produit si une nouvelle photo est téléchargée
        if ($request->hasFile('photo')) {
            $this->deleteFile($product->photo);
            $product->photo = $this->uploadFile($request->file('photo'));
        }

        // Mettre à jour img1 du produit si une nouvelle image est téléchargée
        if ($request->hasFile('imag_one')) {
            $this->deleteFile($product->imag_one);
            $product->imag_one = $this->uploadFile($request->file('imag_one'));
        }

        // Mettre à jour img2 du produit si une nouvelle image est téléchargée
        if ($request->hasFile('imag_two')) {
            $this->deleteFile($product->imag_two);
            $product->imag_two = $this->uploadFile($request->file('imag_two'));
        }

        // Enregistrer les modifications du produit dans la base de données
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update product');
        }
    }


    // Méthode pour supprimer un fichier
  // Méthode pour supprimer un fichier
private function deleteFile($filename)
{
    $file_path = public_path() . '/uploads/' . $filename;

    // Vérifier si le fichier existe
    if (file_exists($file_path) && !is_dir($file_path)) {
        unlink($file_path);
    }
}


    // Méthode pour télécharger un fichier
    private function uploadFile($file)
    {
        $newname = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $newname);
        return $newname;
    }



    public function clients(Request $request){
        $clients = User::query();

        // Filtrer les clients en fonction du nom et de l'état
        if ($request->has('user_name') && $request->user_name != '') {
            $clients->where('name', 'LIKE', '%'.$request->user_name.'%');
        }

        if ($request->has('etat') && $request->etat != '0') {
            $clients->where('is_active', $request->etat == '1' ? true : false);
        }

        // Paginer les résultats
        $clients = $clients->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }



    public function searchProduct(Request $request){
        $categories = Category::all();
        $products = Product::query();

        if ($request->product_name && !$request->qte) {
            $products->where('name', 'LIKE', '%'.$request->product_name.'%');
        }

        if (!$request->product_name && $request->qte) {
            $products->where('qte', '<=', $request->qte); // Utilisation de '<=' pour inclure les produits ayant une quantité inférieure ou égale
        }

        if ($request->product_name && $request->qte) {
            $products->where('name', 'LIKE', '%'.$request->product_name.'%')
                     ->where('qte', '<=', $request->qte); // Utilisation de '<=' pour inclure les produits ayant une quantité inférieure ou égale
        }

        $products = $products->paginate(10);

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function vprod(){
        return view('admin.tabbord.venpro');
    }






public function updateSizeColor(Request $request, $id) {


    $sizeColor = SizeColor::findOrFail($id);
  // Récupération du produit correspondant à l'ID spécifié
  $product = Product::findOrFail($request->product_id);

 // Vérification de la quantité totale disponible
 $totalQuantity = SizeColor::where('id_product', $request->product_id)->sum('qte');
 $requestedQuantity = $request->qte;
 $availableQuantity = $product->qte - $totalQuantity ;




 if(($totalQuantity + $requestedQuantity-$sizeColor->qte) > $product->qte) {
    if(( $requestedQuantity) > $product->qte) {
        return redirect()->back()->with('error', 'La derniere quantité saisie: ' . $requestedQuantity . ' dépasse la quantité totale disponible pour ce produit. quantité  totale :'.$product->qte);

     } else {
    return redirect()->back()->with('error', 'La derniere quantité saisie : ' . $requestedQuantity . ' dépasse la quantité restante à attribuer avec une couleur et/ou une taille spécifique. quantité dispo:'.$availableQuantity);

 }}

    $sizeColor->qte = $request->input('qte');
    if($request->size == ''){
        $size='null';
    }else{
        $sizeColor->size = $request->input('size');
    }
    $sizeColor->color = $request->input('color');
    $sizeColor->save();

    return redirect()->back()->with('success', 'La taille et la couleur ont été mises à jour avec succès!');
}


public function silor(Request $request)

{
    // Récupération du produit correspondant à l'ID spécifié
    $product = Product::findOrFail($request->product_id);
    // Définition des règles de validation
    $rules = [
        'product_id' => 'required|exists:products,id',
        'qte' => 'required|integer|min:0',
    ];

    // Messages d'erreur personnalisés
    $messages = [
        'product_id.required' => 'Le champ ID du produit est requis.',
        'product_id.exists' => 'Le produit spécifié n\'existe pas.',
        'qte.required' => 'Le champ quantité est requis.',
        'qte.integer' => 'La quantité doit être un nombre entier.',
        'qte.min' => 'La quantité doit être positive ou nulle.',
    ];

    // Validation des données
    $validator = Validator::make($request->all(), $rules, $messages);

    // Vérification de la validation et de la saisie de la taille ou de la couleur
    if ($validator->fails() || ($request->size === null && $request->color === null)) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Déclaration des variables $size et $color
    $size = $request->size;
    $color = $request->color;

    if($request->size == ''){
        $size='null';
    }
    if($request->color == ''){
        $color='null';
    }

 // Vérification de la quantité totale disponible
 $totalQuantity = SizeColor::where('id_product', $request->product_id)->sum('qte');
 $requestedQuantity = $request->qte;
 $availableQuantity = $product->qte - $totalQuantity;




 if(($totalQuantity + $requestedQuantity) > $product->qte) {
    if(( $requestedQuantity) > $product->qte) {
        return redirect()->back()->with('error', 'La derniere quantité saisie: ' . $requestedQuantity . ' dépasse la quantité totale disponible pour ce produit. quantité  totale :'.$product->qte);

     } else {
    return redirect()->back()->with('error', 'La derniere quantité saisie : ' . $requestedQuantity . ' dépasse la quantité restante à attribuer avec une couleur ou une taille spécifique. quantité dispo:'.$availableQuantity);

 }}
    // Création d'une nouvelle instance de SizeColor et sauvegarde des données
    $sizeColor = new SizeColor();
    $sizeColor->id_product = $request->product_id;
    $sizeColor->qte = $request->qte;
    $sizeColor->size = $size; // Utilisation de la variable $size qui peut être null
    $sizeColor->color = $color; // Utilisation de la variable $color qui peut être null

    // Sauvegarde de l'instance SizeColor
    if ($sizeColor->save()) {
        return redirect()->back()->with('success', 'Taille et couleur ajoutées avec succès!');
    } else {
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de la taille et de la couleur.');
    }


}


public function size_color($product_id)
{

    // Récupérez les tailles et couleurs depuis la base de données
    $sizesColors = SizeColor::all();

    // Utilisez $product_id pour récupérer les détails du produit
    $product = Product::findOrFail($product_id);

    // Retournez la vue avec les données du produit et les tailles/couleurs
    return view('admin.products.size_color', compact('product', 'sizesColors'));
}


}



