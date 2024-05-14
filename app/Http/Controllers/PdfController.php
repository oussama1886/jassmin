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
   public function generatePdf(){

    $products= Product::get();
        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('d/m/Y'),
            'products' =>  $products
        ];

        $pdf = PDF::loadView('admin.products.generate-product-pdf', $data);
        return $pdf->download('facture.pdf');
   }
}
