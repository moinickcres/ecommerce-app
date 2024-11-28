<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_listing_page_is_accessible()
    {
        $response = $this->get('/products'); // Assuming product listing is at /products

        $response->assertStatus(200);
        $response->assertSee('Products'); // Check if the word 'Products' appears on the page
    }

    public function test_products_are_displayed_correctly()
    {
        Product::factory(3)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);

        // Check if product names are present
        Product::all()->each(function ($product) use ($response) {
            $response->assertSee($product->name);
        });
    }
}
