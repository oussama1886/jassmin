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
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        $commande_id = $request->input('commande_id');

        // Récupérer les lignes de commande de la commande spécifique
        $lc = LigneCommande::where('commande_id', $commande_id)->get();

        // Récupérer d'autres données nécessaires comme le titre, la date, etc.
        $commande = Commande::findOrFail($commande_id);
        $data = [
            'title' => 'Facture de livraison',
            'date' => date('d/m/Y'),
            'lc' =>  $lc,
            // Ajoutez d'autres données ici si nécessaire
        ];

        // Charger la vue PDF avec les données
        $pdf = PDF::loadView('admin.products.generate-product-pdf', $data);

        // Télécharger le PDF avec le nom "facture.pdf"
        return $pdf->download('facture.pdf');
    }
}
