<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $fillable = [
        'product_type',
        'image',
        'name',
        'feature',
        'rank',
        'price',
        'upc',
        'description',
        'product_options',
        'discount',
        'price_after_disc',
        'instore',
        'stock_qantity',
        'points_redeemable',
        'no_of_points',
        'points_earned',
        'have_tax',
        'terms_conditions',
        'konnect_category_id',
        'category_id',
        'tags',
        'cross_selling_products',
        'creation_cost',
        'custom_attribute',
        'available_attribute',
        'variation',
        'variation_all_attribute'
    ];

    //protected $fillable = ['description'];
    use HasFactory;
    
}
