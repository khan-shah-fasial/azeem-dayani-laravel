<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;

    // Define the custom table name
    protected $table = 'products';

    // Define the attributes that should be cast to native types
    protected $casts = [
        'product_category_ids' => 'array',  // Cast to array or JSON
    ];

    // Method to get related categories    // Define the attribute accessor
    public function getCategoriesAttribute()
    {
        // Ensure product_category_ids is always an array
        $categoryIds = $this->product_category_ids ?? [];
        
        // Return the related categories
        return ProductCategory::whereIn('id', $categoryIds)->get();
    }
}
