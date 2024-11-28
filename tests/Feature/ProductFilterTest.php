<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_product_filter_by_category()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();
        Product::factory()->create(['category_id' => $categoryA->id]);
        Product::factory()->create(['category_id' => $categoryB->id]);

        $response = $this->get('/products?category=' . $categoryA->id);
        $response->assertSee($categoryA->name)
                 ->assertDontSee($categoryB->name);
    }
}
