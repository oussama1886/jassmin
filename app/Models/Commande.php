<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public function lignecommandes()
    {
        return $this->hasMany(LigneCommande::class, 'commande_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    use HasFactory;


    public function getTotal(){
        $total=0;
        // liste de ligne de commande $this->lignecommandes as $lc
        foreach($this->lignecommandes as $lc){

            $total+=$lc->product->price*$lc->qte;



        }
        return $total+10;
    }

    public function getTotalClient(){
        $total=0;
        // liste de ligne de commande $this->lignecommandes as $lc
        foreach($this->lignecommandes as $lc){
            if(($lc->product->qte >= $lc->qte))
                $total+=$lc->product->price*$lc->qte;
            else
                $total+=$lc->product->price*$lc->product->qte ;

        }
        return $total+10;
    }


}
