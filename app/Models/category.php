<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];
    
    public function products() :BelongsToMany
    {
        return $this->hasMany(Product::class,'product_categories', 'category_id', 'product_id',);
    }
}
