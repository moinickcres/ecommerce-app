use Tests\TestCase;
use App\Models\Order;
use App\Models\User;

class OrderTest extends TestCase
{
    public function testOrderBelongsToUser()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $order->user->id); // Assert the relationship
    }

    public function testUserHasManyOrders()
    {
        $user = User::factory()->create();
        $orders = Order::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->orders); // Assert the relationship
    }
}
