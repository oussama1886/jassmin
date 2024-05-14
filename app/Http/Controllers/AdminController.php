<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;

use App\Models\SizeColor; // Assurez-vous d'importer le modèle SizeColor si vous ne l'avez pas déjà fait
use App\Models\User; // Import User model

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // fonction qui permet d'afficher le dashboard Admin
    public function dashboard(){

        return view('admin.dashboard');
    }

    public function profile(){
        return view('admin.profile');
    }


/*public function updateProfile(Request $request)
{
    //dd($request);
    Auth::user()->name=$request->name;
    Auth::user()->email=$request->email;
    if($request->password){
    Auth::user()->password = Hash::make($request->password);
    }
    Auth::user()->update();
}
*/
 // Function to update the admin profile
 public function updateProfile(Request $request)
 {if( $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'password' => 'nullable|string|min:8|confirmed', // 'confirmed' valide que le champ 'password'
    //correspond au champ 'password_confirmation'
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

}

public function clients(Request $request) {
    $perPage = 10; // Nombre d'éléments par page

    // Récupérer les clients paginés
    $clients = User::paginate($perPage);

    // Passer les clients paginés à la vue
    return view('admin.clients.index', compact('clients'));
}

public function BloquerUser($iduser){
    $client= User::Find($iduser);
    $client->is_active=false;
    $client->update();
    return redirect()->back()->withErrors('success', 'utilisteur bloquée!');
}

public function DeBloquerUser($iduser){
    $client= User::Find($iduser);
    $client->is_active=true;
    $client->update();
    return redirect()->back()->withErrors('success', 'utilisteur debloquée!');
}

public function commandes(){
    $perPage = 10; // Nombre d'éléments par page

    // Récupérer les commandes paginés
    $commandes = Commande::paginate($perPage);
    return view('admin.commandes.index')->with('commandes',$commandes);
}


public function searchClients(Request $request)
{



        $clients = User::query();

        if ($request->has('id_client') && $request->id_client != '') {
            $clients->where('id', '=', $request->id_client);
        }
        // Filtrer les clients en fonction du nom et de l'état
        if ($request->has('user_name') && $request->user_name != '') {
            $clients->where('name', 'LIKE', '%'.$request->user_name.'%');
        }

        if ($request->has('etat') && $request->etat != '0') {
            $clients->where('is_active', $request->etat == '1' ? true : false);
        }

        // Récupérer les résultats paginés
        $perPage = 10;
        $currentPage = $request->page ?? 1;
        $clients = $clients->paginate($perPage, ['*'], 'page', $currentPage);

        return view('admin.clients.index', compact('clients'));
    }




    public function searchCommandes(Request $request)
{
    // Commencez par créer une requête de base pour les commandes
    $commandes = Commande::query();

    // Filtrer par numéro de commande si le champ est rempli
    if ($request->has('num_com') && $request->filled('num_com')) {
        $commandes->where('id', $request->num_com);
    }

    // Filtrer par nom du client si le champ est rempli
    if ($request->has('id_client') && $request->filled('id_client')) {
        $commandes->whereHas('client', function($query) use ($request) {
            $query->where('id', '=', $request->id_client);
        });
    }

    // Filtrer par état de la commande si le champ est rempli
    if ($request->has('etat') && $request->filled('etat')) {
        if ($request->etat == '0') {
            // Ne rien faire, afficher toutes les commandes
        } elseif ($request->etat == '1') {
            $commandes->where('etat', 'paye');
        } elseif ($request->etat == 'all') {
            $commandes->where('etat', 'en cours');
        }
    }

    // Maintenant, exécutez la requête et paginez les résultats
    $perPage = 10;
    $commandes = $commandes->paginate($perPage);

    // Passez les résultats à la vue
    return view('admin.commandes.index', compact('commandes'));
}

public function searchCommandes1(Request $request)
{
    // Commencez par créer une requête de base pour les commandes
    $commandes = Commande::query();

    // Filtrer par nom du client si le champ est rempli

        $commandes->where('client_id', $request->id_client);


    // Maintenant, exécutez la requête et paginez les résultats
    $perPage = 10;
    $commandes = $commandes->paginate($perPage);

    // Passez les résultats à la vue
    return view('admin.commandes.index', compact('commandes'));
}


public function calculateSum()
{
    // Sélectionner les IDs des commandes payées
    $commandesPayeesIds = Commande::where('etat', 'paye')->pluck('id');

    // Sélectionner les lignes de commande correspondantes aux commandes payées
    $sums = LigneCommande::whereIn('commande_id', $commandesPayeesIds) // Assurez-vous que le nom de la colonne est correct
        ->groupBy('product_id')
        ->selectRaw('product_id, SUM(qte) as total_quantity')
        ->get();

    $productIds = $sums->pluck('product_id')->toArray();
    $totalQuantities = $sums->pluck('total_quantity')->toArray();

    return view('admin.tabbord.vprod', compact('productIds', 'totalQuantities'));
}

public function calculateSum1()
{
    // Sélectionner les IDs des commandes payées
    $commandesPayeesIds = Commande::where('etat', 'paye')->pluck('id');

    // Sélectionner les lignes de commande correspondantes aux commandes payées
    $sums = LigneCommande::whereIn('commande_id', $commandesPayeesIds)
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(qte) as total_quantity')
        ->groupBy('year', 'month')
        ->get();

    // Préparer les données pour le graphique
    $yearMonthsQuantities = [];

    // Parcourir les résultats pour récupérer les données
    foreach ($sums as $sum) {
        // Ajouter la quantité totale vendue pour ce mois à l'année correspondante
        $yearMonthsQuantities[$sum->year][($sum->month - 1)] = $sum->total_quantity;
    }

    // Configuration des options pour le graphique
    $options = [
        'scales' => [
            'xAxes' => [
                [
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Mois'
                    ]
                ]
            ],
            'yAxes' => [
                [
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Nombre d\'articles vendus'
                    ]
                ]
            ]
        ]
    ];

    return view('admin.tabbord.vmois', compact('yearMonthsQuantities', 'options'));
}






public function calculateSum2()
{
    // Sélectionner les IDs des commandes payées
    $commandesPayeesIds = Commande::where('etat', 'paye')->pluck('id');

    // Sélectionner les lignes de commande correspondantes aux commandes payées
    $sums = LigneCommande::whereIn('commande_id', $commandesPayeesIds)
        ->join('products', 'ligne_commandes.product_id', '=', 'products.id')
        ->selectRaw('YEAR(ligne_commandes.created_at) as year, MONTH(ligne_commandes.created_at) as month, SUM(ligne_commandes.qte * (products.price - products.purchase_price)) as total_revenue')
        ->groupBy('year', 'month')
        ->get();

    // Préparer les données pour le graphique des revenus
    $yearMonthsRevenues = [];

    // Préparer les données pour le graphique des quantités vendues
    $yearMonthsQuantities = [];

    // Parcourir les résultats pour récupérer les données
    foreach ($sums as $sum) {
        // Ajouter le revenu total pour ce mois à l'année correspondante
        $yearMonthsRevenues[$sum->year][($sum->month - 1)] = $sum->total_revenue;

        // Calculer les quantités totales vendues pour ce mois à l'année correspondante
        $yearMonthsQuantities[$sum->year][($sum->month - 1)] = LigneCommande::whereIn('commande_id', $commandesPayeesIds)
            ->whereYear('created_at', $sum->year)
            ->whereMonth('created_at', $sum->month)
            ->sum('qte');
    }

    // Configuration des options pour le graphique
    $options = [
        'scales' => [
            'xAxes' => [
                [
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Mois'
                    ]
                ]
            ],
            'yAxes' => [
                [
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Revenu'
                    ]
                ]
            ]
        ]
    ];

    return view('admin.tabbord.chiffre', compact('yearMonthsRevenues', 'options', 'yearMonthsQuantities'));
}




/* public function calculateSum()
{
    $sums = LigneCommande::groupBy('product_id')
        ->selectRaw('product_id, SUM(qte) as total_quantity')
        ->get();

    $productIds = $sums->pluck('product_id')->toArray();
    $totalQuantities = $sums->pluck('total_quantity')->toArray();

    return view('admin.dashboard', compact('productIds', 'totalQuantities'));
} */


// AdminController.php



public function calculSum()
{


    {







    }
    // Calculer le nombre de commandes payées
    $totalPaye = Commande::where('etat', 'paye')->count();

    // Calculer le nombre de commandes en cours
    $totalEnCours = Commande::where('etat', 'en cours')->count();
    $lowStockCount = Product::where('qte', '<', 20)->count();

    // Préparer les données pour le graphique
    $data = [
        'paye' => $totalPaye,
        'en_cours' => $totalEnCours
    ];


    $sum_pro = Product::count();
    $sum_cat =Category::count();

    $sum_compte =User::count();
    // Vérifier les données en utilisant dd()
    //dd($data);

    {
        // Sélectionner les IDs des commandes payées
        $commandesPayeesIds = Commande::where('etat', 'paye')->pluck('id');

        // Sélectionner les lignes de commande correspondantes aux commandes payées
        $sums = LigneCommande::whereIn('commande_id', $commandesPayeesIds)
            ->groupBy('product_id')
            ->selectRaw('product_id, SUM(qte) as total_quantity')
            ->get();

        // Initialiser les variables pour stocker l'ID du produit avec la quantité maximale et minimale
        $maxProductId = null;
        $minProductId = null;
        $maxQuantity = null;
        $minQuantity = null;

        // Parcourir les résultats pour trouver la quantité maximale et minimale
        foreach ($sums as $sum) {
            if ($maxQuantity === null || $sum->total_quantity > $maxQuantity) {
                $maxQuantity = $sum->total_quantity;
                $maxProductId = $sum->product_id;
            } }
            $minQuantity= $maxQuantity;
            $minProductId = $maxProductId;
            foreach ($sums as $sum) {
            if ($minQuantity === null || $sum->total_quantity < $minQuantity) {
                $minQuantity = $sum->total_quantity;
                $minProductId = $sum->product_id;
            }}


    }
    { // Calculer la moyenne mensuelle des revenus pour chaque année
        // Obtenez l'année actuelle
        $currentYear = date('Y');

        // Calculez l'année il y a trois ans
        $threeYearsAgo = $currentYear - 3;
        $commandesPayeesIds = Commande::where('etat', 'paye')->pluck('id');
        // Sélectionnez les lignes de commande correspondantes aux commandes payées et aux trois dernières années
        $sums = LigneCommande::whereIn('commande_id', $commandesPayeesIds)
            ->join('products', 'ligne_commandes.product_id', '=', 'products.id')
            ->whereYear('ligne_commandes.created_at', '>=', $threeYearsAgo)
            ->selectRaw('YEAR(ligne_commandes.created_at) as year, MONTH(ligne_commandes.created_at) as month, SUM(ligne_commandes.qte * (products.price - products.purchase_price)) as total_revenue')
            ->groupBy('year', 'month')
            ->get();

        // Calculer le total des revenus pour chaque année et mois
        $monthlyRevenues = $sums->groupBy('year')->map(function($items) {
            return $items->groupBy('month')->map(function($subItems) {
                return $subItems->sum('total_revenue');
            });
        });

        // Calculer la moyenne mensuelle des revenus pour chaque année
        $averageMonthlyRevenues = [];
        foreach ($monthlyRevenues as $year => $monthlyRevenue) {
            $averageMonthlyRevenues[$year] = $monthlyRevenue->avg();
        }


    }

    // Passer les données à la vue et afficher la vue
   return view('admin.dashboard', compact('data','sum_pro', 'lowStockCount', 'sum_cat','sum_compte','maxProductId', 'minProductId', 'maxQuantity', 'minQuantity','averageMonthlyRevenues'));
}


public function calculSum1()
{
    // Calculer le nombre de commandes payées
    $totalPaye = Commande::where('etat', 'paye')->count();

    // Calculer le nombre de commandes en cours
    $totalEnCours = Commande::where('etat', 'en cours')->count();



    // Préparer les données pour le graphique
    $data = [
        'paye' => $totalPaye,
        'en_cours' => $totalEnCours
    ];

    // Vérifier les données en utilisant dd()
    //dd($data);

    // Passer les données à la vue et afficher la vue
   return view('admin.tabbord.commandes', compact('data'));
}


public function utilisateur()
{
    // Calculer le nombre de commandes payées
    $totalPaye = User::where('is_active', '1')->count();

    // Calculer le nombre de commandes en cours
    $totalEnCours = User::where('is_active', '0')->count();

    // Préparer les données pour le graphique
    $data = [
        'paye' => $totalPaye,
        'en_cours' => $totalEnCours
    ];

    // Vérifier les données en utilisant dd()
    //dd($data);

    // Passer les données à la vue et afficher la vue
   return view('admin.tabbord.utilisateur', compact('data'));
}

/*
public function dashboard1()
{
    $sum_pro = Product::count();
    $sum_cat =Category::count();

    return view('admin.dashboard', compact('sum_pro', 'sum_cat'));
} */


public function trivente()
{
    // Sélectionner les produits avec leur quantité vendue, triés par quantité vendue
    $paginatedProducts = Product::join('ligne_commandes', 'products.id', '=', 'ligne_commandes.product_id')
        ->join('commandes', 'ligne_commandes.commande_id', '=', 'commandes.id')
        ->where('commandes.etat', 'paye')
        ->select('products.*', DB::raw('SUM(ligne_commandes.qte) as total_quantity'))
        ->groupBy('products.id')
        ->orderByDesc('total_quantity')
        ->paginate(10); // Paginer les résultats

    // Récupérer les sommes pour afficher les quantités vendues dans la vue
    $sums = LigneCommande::whereIn('commande_id', Commande::where('etat', 'paye')->pluck('id'))
        ->groupBy('product_id')
        ->selectRaw('product_id, SUM(qte) as total_quantity')
        ->get();

    // Retourner la vue avec les données paginées et les sommes
    return view('admin.tabbord.tri_vente', compact('paginatedProducts', 'sums'));
}



public function categProduit (){
    // Récupérer toutes les catégories
    $categories = Category::all();

    // Initialiser un tableau pour stocker la somme des produits par catégorie
    $sums = [];

    // Pour chaque catégorie, calculer la somme des produits correspondants
    foreach ($categories as $category) {
        $sums[$category->name] = Product::where('category_id', $category->id)->sum('qte');
    }

    // Récupérer le nombre de produits par catégorie
    $countProductsByCategory = Product::select('category_id', DB::raw('COUNT(*) as total'))
        ->groupBy('category_id')
        ->get();

    // Retourner la vue avec les données
    return view('admin.tabbord.catprod', compact('categories', 'sums', 'countProductsByCategory'));
}















}

