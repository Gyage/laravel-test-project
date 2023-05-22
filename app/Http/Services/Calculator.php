<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\OrderItem;

class Calculator
{
    public static function calculateTotal(Order &$order): int
    {
        $total = 0;

        foreach ($order->orderItems()->get() as $orderItem) {
            $subtotal = self::calculateSubtotal($orderItem);
            $orderItem->update(['subtotal' => $subtotal]);
            $total += $subtotal;
        }

        return $total;
    }

    public static function calculateSubtotal(OrderItem $orderItem): int
    {
        $subtotal = $fives = $threes = 0;

        if (isset($orderItem->product->price_5) && ($fives = floor($orderItem->count / 5)) > 0) {
            $subtotal += ($orderItem->product->price_5 * $fives);
        }
        if (isset($orderItem->product->price_3) && ($threes = floor(($orderItem->count - ($fives * 5)) / 3)) > 0) {
            $subtotal += ($orderItem->product->price_3 * $threes);
        }
        if ($ones = ($orderItem->count - ($fives * 5) - ($threes * 3)) > 0) {
            $subtotal += ($orderItem->product->price_1 * $ones);
        }

        return $subtotal;
    }
}
