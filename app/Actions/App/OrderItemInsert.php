<?php

namespace App\Actions\App;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemInsert
{
    public static function execute(Order &$order, array $formFields)
    {
        $toUpdate = false;
        foreach ($order->orderItems as $k => $item) {
            if ($item->product_id == $formFields['product_id']) {
                $toUpdate = $k;
                break;
            }
        }

        if (is_numeric($toUpdate)) {
            $count = $order->orderItems[$toUpdate]->count + $formFields['count'];
            $orderitem = $order->orderItems[$toUpdate];
            $orderitem->update(['count' => $count]);
        } else {
            $orderitem = OrderItem::create($formFields);
        }
    }
}
