<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Add this

    protected $fillable = ['name', 'price', 'category_id']; // Add fillable fields
}