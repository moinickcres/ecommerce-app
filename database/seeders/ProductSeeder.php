<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone with advanced features.',
            'price' => 699.99,
            'stock' => 50,
            'category_id' => 1, // Electronics
        ]);

        Product::create([
            'name' => 'T-shirt',
            'description' => 'Comfortable cotton t-shirt.',
            'price' => 19.99,
            'stock' => 100,
            'category_id' => 2, // Clothing
        ]);

        Product::create([
            'name' => 'Novel',
            'description' => 'Best-selling fiction novel.',
            'price' => 12.99,
            'stock' => 200,
            'category_id' => 3, // Books
        ]);
    }
}