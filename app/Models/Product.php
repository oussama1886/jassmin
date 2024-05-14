<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function ligneCommande()
    {
        return $this->hasMany(LigneCommande::class,'product_id','id');
    }
    public function sizeColors()
    {
        return $this->belongsToMany(SizeColor::class, 'product_size_color')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    use HasFactory;
}
