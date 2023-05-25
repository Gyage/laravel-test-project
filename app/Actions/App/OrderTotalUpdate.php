<?php

namespace App\Actions\App;

use App\Models\Order;
use App\Models\OrderItem;

class OrderTotalUpdate
{
    public static function execute(Order &$order): int
    {
        $total = 0;

        foreach ($order->orderItems()->get() as $orderItem) {
            $subtotal = self::calculateSubtotal($orderItem);
            $orderItem->update(['subtotal' => $subtotal]);
            $total += $subtotal;
        }

        $order->update(['total' => $total]);
        
        return $total;
    }

    private static function calculateSubtotal(OrderItem &$orderItem): int
    {
        $subtotal = 0;

        $fives = floor($orderItem->count / 5);
        $threes = $orderItem->count % 5;
        $ones = $threes % 3;

        $subtotal += ($orderItem->product->price_5 * $fives);
        $subtotal += ($orderItem->product->price_3 * $threes);
        $subtotal += ($orderItem->product->price_1 * $ones);

        return $subtotal;
    }
}
