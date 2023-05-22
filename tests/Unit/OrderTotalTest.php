<?php

namespace Tests\Unit;

use App\Http\Services\Calculator;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Tests\TestCase;

class OrderTotalTest extends TestCase
{
    public function test_example(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'név',
            'email' => 'aaa@aaa.aa',
            'password' => bcrypt('a'),
        ]);

        $product = Product::factory()->create([
            'user_id' => $user->id,
            'price_1' => 1,
            'price_3' => 10,
            'price_5' => 100,
        ]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
        ]);

        $orderitem = OrderItem::factory()->create([
            'product_id' => $product->id,
            'order_id' => $order->id,
            'count' => 5,
        ]);
         
        $this->assertEquals(100, Calculator::calculateTotal($order));
    }
}
