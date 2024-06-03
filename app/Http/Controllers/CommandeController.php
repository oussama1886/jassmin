<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\SizeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class CommandeController extends Controller
{
    public function store(Request $request)
    {//dd($request);
        if (Auth::check()) {
            Log::info('User is authenticated');
            return $this->storeForAuthenticatedUser($request);
        } else {
            Log::info('User is not authenticated');
            return $this->storeUnauthenticatedUser($request);
        }
    }

    private function getAvailableQuantity($productId, $size, $color)
    {
        $qtesc = SizeColor::where('id_product', $productId)
                          ->where('size', $size)
                          ->where('color', $color)
                          ->first();

        return $qtesc ? $qtesc->qte : Product::find($productId)->qte;
    }

    private function createOrUpdateLineCommand($commande, $productId, $size, $color, $quantity)
    {
        $existingLine = $commande->lignecommandes()
                                 ->where('product_id', $productId)
                                 ->where('size', $size)
                                 ->where('color', $color)
                                 ->first();

        if ($existingLine) {
            $availableQuantity = $this->getAvailableQuantity($productId, $size, $color);
            $totalQuantity = $quantity + $existingLine->qte;

            if ($totalQuantity <= $availableQuantity) {
                $existingLine->qte = min($totalQuantity, 10);
            } else {
                $existingLine->qte = $availableQuantity;
            }
            $existingLine->update();
        } else {
            $lc = new LigneCommande();
            $lc->product_id = $productId;
            $lc->commande_id = $commande->id;
            $lc->size = $size;
            $lc->color = $color;
            $lc->qte = min($quantity, $this->getAvailableQuantity($productId, $size, $color));
            $lc->save();
        }
    }
    public function ligneCommandeDestroy($idlc)
    {
        $lc = LigneCommande::findOrFail($idlc);
        $lc->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès.');
    }

    private function storeForAuthenticatedUser(Request $request)
    {
        $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();
        $quantite = $this->getAvailableQuantity($request->product, $request->size, $request->color);

        if ($commande) {
            $this->createOrUpdateLineCommand($commande, $request->product, $request->size, $request->color, $request->qte);
        } else {
            $commande = new Commande();
            $commande->client_id = Auth::user()->id;
            if (!$commande->save()) {
                return redirect('/client/cart')->with('error', 'Impossible de passer la commande.');
            }
            $this->createOrUpdateLineCommand($commande, $request->product, $request->size, $request->color, $request->qte);
        }
        return redirect('/client/cart')->with('success', 'Produit commandé avec succès.');
    }

 /*    private function storeUnauthenticatedUser(Request $request)


    {// Stoker une variable dans la session

        session(['product_id' =>  $request->product]);

       /*  $cart = session()->get('cart', []);
        $key = $request->product . '-' . $request->size . '-' . $request->color;

        if (isset($cart[$key])) {
            $cart[$key]['qte'] += $request->qte;
            if ($cart[$key]['qte'] > 10) {
                $cart[$key]['qte'] = 10;
            }
        } else {
            $cart[$key] = [
                'product_id' => $request->product,
                'size' => $request->size,
                'color' => $request->color,
                'qte' => $request->qte
            ];
        }

        session()->put('cart', $cart);


        return redirect('/client/cart')->with('success', 'Produit ajouté au panier avec succès.');
    } */

    /*private function storeUnauthenticatedUser(Request $request)
    {
        session([
            'product_id' => $request->product,
            'size' => $request->size,
            'color' => $request->color,
            'qte' => $request->qte
        ]);

        return redirect('/client/cart')->with('success', 'Produit ajouté au panier avec succès.');
    }
    */
    public function storeUnauthenticatedUser(Request $request)
    {
        // Récupérer le panier actuel depuis la session ou initialiser un nouveau panier
        $cart = session()->get('cart', []);

        // Créer une clé unique pour chaque produit en utilisant les informations du produit
        $key = $request->product . '-' . $request->size . '-' . $request->color;

        // Vérifier si le produit existe déjà dans le panier
        if (isset($cart[$key])) {
            // Mettre à jour la quantité du produit
            $cart[$key]['qte'] += $request->qte;
            // Limiter la quantité à 10
            if ($cart[$key]['qte'] > 10) {
                $cart[$key]['qte'] = 10;
            }
        } else {
            // Ajouter un nouveau produit au panierf
            $cart[$key] = [
                'product_id' => $request->product,
                'size' => $request->size,
                'color' => $request->color,
                'qte' => $request->qte
            ];
        }

        // Stocker le panier mis à jour dans la session
        session(['cart' => $cart]);

        // Redirection vers la vue du panier
        return redirect('/guest/cart1')->with(['success' => 'Produit ajouté au panier avec succès.']);
    }



    public function showCart1()
{
    // Récupérer le panier depuis la session
    $cart = session()->get('cart', []);

    // Vérifiez le contenu du panier avant l'affichage
  /*   dd($cart); */

    // Retourner la vue avec le panier
    return view('guest.cart1', ['cart' => $cart]);
}



    public function CommandeDetails($id_cmd)
    {
        $lc = LigneCommande::where('commande_id', $id_cmd)->get();
        $produit = Product::All();

        return view('admin.commandes.details_commande', compact('lc', 'produit'));
    }
/////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////
    public function store1(Request $request)
{
    if (Auth::check()) {
        Log::info('User is authenticated');
        return $this->storeForAuthenticatedUser1($request);
    } else {
        Log::info('User is not authenticated');
        return $this->storeUnauthenticatedUser1($request);
    }
}

private function getAvailableQuantity1($products)
{
    $availableQuantities = [];

    foreach ($products as $product) {
        $productId = $product['product_id'];
        $size = $product['size'];
        $color = $product['color'];

        $qtesc = SizeColor::where('id_product', $productId)
                          ->where('size', $size)
                          ->where('color', $color)
                          ->first();

        $availableQuantities[$productId] = $qtesc ? $qtesc->qte : Product::find($productId)->qte;
    }

    return $availableQuantities;
}

private function createOrUpdateLineCommand1($commande, $products)
{
    foreach ($products as $product) {
        $productId = $product['product_id'];
        $size = $product['size'];
        $color = $product['color'];
        $quantity = $product['qte'];

        $existingLine = $commande->lignecommandes()
                                 ->where('product_id', $productId)
                                 ->where('size', $size)
                                 ->where('color', $color)
                                 ->first();

        if ($existingLine) {
            $availableQuantity = $this->getAvailableQuantity1([$product])[$productId];
            $totalQuantity = $quantity + $existingLine->qte;

            if ($totalQuantity <= $availableQuantity) {
                $existingLine->qte = min($totalQuantity, 10);
            } else {
                $existingLine->qte = $availableQuantity;
            }
            $existingLine->update();
        } else {
            $lc = new LigneCommande();
            $lc->product_id = $productId;
            $lc->commande_id = $commande->id;
            $lc->size = $size;
            $lc->color = $color;
            $lc->qte = min($quantity, $this->getAvailableQuantity1([$product])[$productId]);
            $lc->save();
        }
    }
}

private function storeForAuthenticatedUser1(Request $request)
{
    $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();
    $products = $request->input('products');
    $availableQuantities = $this->getAvailableQuantity1($products);

    if ($commande) {
        $this->createOrUpdateLineCommand1($commande, $products);
    } else {
        $commande = new Commande();
        $commande->client_id = Auth::user()->id;
        if (!$commande->save()) {
            return redirect('/client/cart')->with('error', 'Impossible de passer la commande.');
        }
        $this->createOrUpdateLineCommand1($commande, $products);
    }
    return redirect('/client/cart')->with('success', 'Produits commandés avec succès.');
}
public function remove(Request $request)
{
    // Récupérer la clé du produit à supprimer
    $productId = $request->input('product_id');

    // Récupérer le panier de la session
    $cart = session()->get('cart', []);

    // Trouver la clé exacte du produit dans le panier
    $itemKey = null;
    foreach ($cart as $key => $item) {
        if ($item['product_id'] == $productId) {
            $itemKey = $key;
            break;
        }
    }

    // Vérifier si l'article correspondant à $productId existe dans le panier
    if ($itemKey !== null) {
        // Supprimer l'article du panier
        unset($cart[$itemKey]);
        // Ajouter un message de confirmation
        session()->flash('success', 'Produit supprimé du panier avec succès.');
    } else {
        // Ajouter un message d'erreur
        session()->flash('error', 'Produit introuvable dans le panier.');
    }

    // Mettre à jour le panier dans la session
    session()->put('cart', $cart);

    // Retourner la vue avec le panier mis à jour
    return view('guest.cart1', ['cart' => $cart]);
}


public function remove1(Request $request)
{/* dd($request->all()); */
    // Récupérer la clé du produit à supprimer
    $productId = $request->input('product_id');
  /*   dd($productId); */
    // Récupérer le panier de la session
    $cart = session()->get('cart', []);
    dd($cart);
    // Vérifier si l'article correspondant à $productId existe dans le panier
    if(array_key_exists($productId, $cart)) {
        // Supprimer l'article du panier
        unset($cart[$productId]);
    }

    // Mettre à jour le panier dans la session
    session()->put('cart', $cart);

    // Rediriger l'utilisateur vers la page du panier après la suppression
    return view('guest.cart1', ['cart' => $cart]);
}





}
