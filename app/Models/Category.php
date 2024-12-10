<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // Add this

    protected $fillable = ['name']; // Add fillable fields

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
