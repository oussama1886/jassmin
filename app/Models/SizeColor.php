<?php

// app/Models/SizeColor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeColor extends Model
{
    protected $fillable = ['size', 'color'];

    // Définition de la relation many-to-many avec le modèle Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_color')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
