<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $dates = ['deleted_at']; // Ensure `deleted_at` is treated as a date
    
    public function products() :BelongsToMany
    {
        return $this->hasMany(Product::class,'product_categories', 'category_id', 'product_id',);
    }
}
