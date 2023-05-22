<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $user = \App\Models\User::factory()->create([
            'name' => 'név',
            'email' => 'aaa@aaa.aa',
            'password' => bcrypt('a'),
        ]);

        \App\Models\User::factory(5)->create();

        $products = \App\Models\Product::factory(5)->create([
            'user_id' => $user->id
        ]);

        \App\Models\Product::factory(10)->create([
            'user_id' => fake()->numberBetween(1, 6)
        ]);

        $order = \App\Models\Order::factory()->create([
            'user_id' => $user->id,
            'is_finished' => true
        ]);

        foreach ($products as $product) {
            \App\Models\OrderItem::factory()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
            ]);
        }
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
