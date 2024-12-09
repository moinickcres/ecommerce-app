<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',   // Add this attribute as it's required for your use case
        'product_id', // Example additional fields
        'user_id',
        'quantity',
        'total_price',
        'status',
    ];
}
