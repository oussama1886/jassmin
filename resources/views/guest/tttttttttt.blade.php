<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\Review;
use App\Models\SizeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //
     // fonction qui permet d'afficher le dashboard Client
     public function dashboard(){
        return view('client.dashboard');
    }

    public function profile(){
        return view('/client/profile');
    }

    public function register(){
        return view('/client/profile');
    }
 // Function to update the admin profile

 /* public function updateProfile(Request $request)
 {if( $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'password' => 'nullable|string|min:8|confirmed', // 'confirmed' valide que le champ 'password' correspond au champ 'password_confirmation'
])){



     $user = Auth::user(); // Get authenticated user
     $user->name = $request->name; // Update name
     $user->email = $request->email; // Update email

     // Check if password is provided and update if necessary
     if ($request->password) {
         $user->password = Hash::make($request->password); // Hash and update password
     }

     $user->save(); // Save changes
     return redirect()->back()->with('success', 'Profile updated successfully!'); // Return with success message
 }
 else {
    return redirect()->back()->withErrors('Les informations fournies ne sont pas valides. Veuillez vérifier et réessayer.');
}

} */


public function updateProfile(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'phone' => 'nullable|string|max:20', // Règles de validation pour le numéro de téléphone
        'adress' => 'nullable|string|max:255', // Règles de validation pour l'adresse
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Règles de validation pour la photo
    ]);

    $user = Auth::user(); // Récupérer l'utilisateur authentifié

    // Mettre à jour le nom et l'email de l'utilisateur
    $user->name = $request->name;
    $user->email = $request->email;

    // Mettre à jour le numéro de téléphone si un nouveau numéro est fourni
    if ($request->phone) {
        $user->phone = $request->phone;
    }

    // Mettre à jour l'adresse si une nouvelle adresse est fournie
    if ($request->adress) {
        $user->adress = $request->adress;
    }

    // Vérifier si un nouveau mot de passe est fourni et le mettre à jour si nécessaire
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Vérifier si une nouvelle photo est téléchargée et la mettre à jour si nécessaire
    if ($request->hasFile('photo')) {
        // Stocker le fichier dans le dossier de stockage public
        $photo = $request->file('photo');
        $fileName = time() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path('dashassets/img/client/'), $fileName);
        // Mettre à jour le chemin de la photo de profil dans la base de données
        $user->photo = $fileName;
    }

    // Sauvegarder les changements dans la base de données
    $user->save();

    // Rediriger l'utilisateur avec un message de succès
    return view('client.dashboard')->with('success', 'Profile updated successfully!');
}



public function updatePassword(Request $request)
{
    // Validation des données du formulaire
    $request->validate([

        'password' => 'nullable|string|min:8|confirmed',

    ]);

    $user = Auth::user(); // Récupérer l'utilisateur authentifié





    // Vérifier si un nouveau mot de passe est fourni et le mettre à jour si nécessaire
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }



    // Sauvegarder les changements dans la base de données
    $user->save();

    // Rediriger l'utilisateur avec un message de succès
    return view('client.dashboard')->with('success', 'Profile updated successfully!');
}
public function addReview(Request $request){

//dd($request);

$review=new Review();
$review->rate=$request->rate;
$review->product_id=$request->product_id;
$review->content=$request->content;
$review->user_id=Auth::user()->id;
$review->save();
//dd($request);
return redirect()->back();
}

/* public function cart()
{
    $categories = category::all();

    if (Auth::check()) { // Vérifiez si un utilisateur est authentifié
        $commande = Commande::where('client_id', Auth::user()->id)
                             ->where('etat', 'en cours')
                             ->first();
    } else {
        $commande = Commande::where('etat', 'en cours')->first();
    }

    return view('guest.cart')->with('categories', $categories)->with('commande', $commande);
} */
public function cart()
{
    $sizecolors = SizeColor::all();
    $categories = Category::all();
    $userId = Auth::id(); // Obtenez l'ID de l'utilisateur actuellement authentifié

    if ($userId) { // Vérifiez si un utilisateur est authentifié
        $commande = Commande::where('client_id', $userId)
                             ->where('etat', 'en cours')
                             ->first();

        // Si aucune commande n'est trouvée pour l'utilisateur actuel, créez-en une nouvelle
        if (!$commande) {
            $commande = new Commande();
            $commande->client_id = $userId;
            $commande->etat = 'en cours';
            $commande->save();
        }

        return view('guest.cart')
            ->with('categories', $categories)
            ->with('commande', $commande)
            ->with('sizecolors', $sizecolors);

    } else {
        return view('guest.cart')
            ->with('categories', $categories)
            ->with('sizecolors', $sizecolors);
    }
}







public function checkout(Request $request){
   /*  dd($request); */
   /*  $commande = Commande::find($request->commande_id); */
    $commande = Commande::with('lignecommandes.product')->find($request->commande_id);

    $commande->etat = "paye";


 /*    dd($qtesc); */

    foreach ($commande->lignecommandes as $lc) {
        $produit = Product::find($lc->product_id);
        $qtesc = SizeColor::where('id_product', $lc->product_id)
        ->where('size', $lc->size) // Utilisez $lc->size au lieu de $request->size
        ->where('color', $lc->color) // Utilisez $lc->color au lieu de $request->color
        ->first();


        if ($qtesc) {

            if ($produit &&  $qtesc->qte >= $lc->qte) {
          // Déduire la quantité commandée du stock du produit
          $produit->qte -= $lc->qte;
          $produit->update();
          $qtesc->qte -= $lc->qte;
            $qtesc->save();
      } else {
          // Si la quantité demandée dépasse la quantité en stock, mettez la quantité en stock à zéro
          if ($produit &&   $qtesc->qte < $lc->qte) {
            $lc->qte = $qtesc->qte;
            $lc->update();

            $qtesc->qte = 0;
            $qtesc->save();

              /* $qtesc->delete(); */
             $produit->qte -= $lc->qte;
          $produit->update();
          }
          // Mettre à jour l'état de la commande
          $commande->etat = "paye"; // ou un autre état approprié si la commande n'a pas pu être complétée
      }


    } else {
        if ($produit && $produit->qte >= $lc->qte) {
            // Déduire la quantité commandée du stock du produit
            $produit->qte -= $lc->qte;
            $produit->save();
        } else {
            // Si la quantité demandée dépasse la quantité en stock du produit, mettez la quantité en stock à zéro
            if ($produit && $produit->qte < $lc->qte) {
                $lc->qte = $produit->qte;
                $lc->update();
                $produit->qte = 0;
                $produit->save();
            }
        }
    }
}

$commandeData = [
    'id' => $commande->id,
    'etat' => $commande->etat,
    'lignecommandes' => $commande->lignecommandes->map(function ($lc) {
        return [
            'id' => $lc->id,
            'product_id' => $lc->product_id,
            'qte' => $lc->qte,
            'size' => $lc->size,
            'color' => $lc->color,
            'product_name' => $lc->product->name, // Add product name
            'product_price' => $lc->product->price, // Add product price
        ];
    }),
];
// Mettre à jour l'état de la commande
$commande->etat = "paye";
$commande->save();


    // Redirection vers la page des commandes avec un message approprié OLD CODE
    //return view('/client/commandes', compact('commande'));
    return redirect('http://jasminshop.test')->with('success_message', 'Achat réussie avec succès');

}



public function moncommande(){

    $categories=category::all();
    $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
    return view('guest.inc.topbar')->with('categories',$categories)->with('commande-id',$commande->id);
}

public function mescommandes(){
    return view('client.commandes');
}

public function afficherMessageBloquee(){
    return view('client.bloquer');
}



/* public function checkout()
{
    // Créer une nouvelle commande
    $commande = new Commande();
    $commande->client_id = Auth::id(); // L'ID du client actuellement authentifié
    $commande->save();

    // Récupérer les produits du panier
    $cart = session('cart', []);

    foreach ($cart as $item) {
        // Ajouter chaque produit à la table ligne_commandes
        $ligneCommande = new LigneCommande();
        $ligneCommande->qte = $item['qte'];
        $ligneCommande->product_id = $item['product_id'];
        $ligneCommande->commande_id = $commande->id;
        $ligneCommande->save();
    }

    // Effacer le panier après la création de la commande
    session()->forget('cart');

    // Rediriger vers la page de commande
    return redirect()->route('commande.show', $commande->id)->with('success', 'Votre commande a été passée avec succès!');
} */
}
