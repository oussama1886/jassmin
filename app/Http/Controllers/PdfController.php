<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\Review;
use App\Models\SizeColor;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        $commande_id = $request->input('commande_id');

        // Récupérer les lignes de commande de la commande spécifique
        $lc = LigneCommande::where('commande_id', $commande_id)->get();

        // Récupérer d'autres données nécessaires comme le titre, la date, etc.
        $commande = Commande::findOrFail($commande_id);
       // Récupérer l'ID de l'utilisateur associé à la commande
      $Iduser = Commande::where('id', $commande_id)->pluck('client_id');

     // Récupérer le nom de l'utilisateur en utilisant son ID
      $user = User::where('id', $Iduser)->pluck('name');


        $data = [
            'title' => 'Facture de livraison',
            'date' => date('d/m/Y'),
            'commande_id'=>$commande_id,
            'commande'=>$commande,
            'lc' =>  $lc,
            'user_name'=>$user,
        ];

        // Charger la vue PDF avec les données
        $pdf = PDF::loadView('admin.products.generate-product-pdf', $data);

        // Télécharger le PDF avec le nom "facture.pdf"
        return $pdf->download('facture.pdf');
    }
}
