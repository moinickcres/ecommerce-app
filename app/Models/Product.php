<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Add this

    protected $fillable = ['name', 'price', 'category_id']; // Ensure 'category_id' is fillable

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}