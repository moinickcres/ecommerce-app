<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // Add this

    protected $fillable = ['name', 'description']; // Add fillable fields
}
