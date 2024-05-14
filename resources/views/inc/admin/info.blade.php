


{{-- pour avoir tt les données de table commande--}}
@auth
<div class="row px-xl-5 pb-3">
    @foreach(auth()->user()->commandes as $index => $commande)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <!-- You can add any content related to the order header here -->
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3"> {{ $commande->id }}</h6>
                    <td> {{ $commande->client->name}} </td>
                    <h6 class="text-truncate mb-3"> {{ $commande->getTotal() }} TND</h6>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endauth

{{-- pour avoir tt les données de table lignede commande--}}
@auth
<div class="row px-xl-5 pb-3">
@foreach(auth()->user()->commandes as $commande)
    @foreach($commande->lignecommandes as $lignec)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <!-- Vous pouvez ajouter n'importe quel contenu lié à l'en-tête de la commande ici -->
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3"> {{ $lignec->id }}</h6>
                    <h6 class="text-truncate mb-3"> {{ $lignec->qte }} </h6>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
</div>
@endauth


 {{-- pour avoir tt les données de table produits--}}

     <div class="row px-xl-5 pb-3">
     @foreach ($produits as $p)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
         <div class="card product-item border-0 mb-4">
             <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">


             </div>
             <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                 <h6 class="text-truncate mb-3">{{ $p->id }}</h6>
                 <h6 class="text-truncate mb-3">{{ $p->qte }}</h6>

             </div>
         </div>
     </div>

@endforeach
</div>





 </div>
</div>
</div>
