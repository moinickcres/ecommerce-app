<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;

class CartManageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_add_product_to_cart()
    {
        $product = Product::factory()->create();

        Livewire::test('cart.manage')
            ->call('addToCart', $product->id)
            ->assertSee($product->name);
    }
}
