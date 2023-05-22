<?php

namespace App\Http\Controllers;

use App\Http\Services\Calculator;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index() {
        return Inertia::render('Orders/List', [
            'orders' => Order::own(['id' => auth()->id()])->get(),
        ]);
    }

    public function show(User $user) {
        if ($user->id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return Inertia::render('Orders/Show', [
            'order' => Order::own(['id' => $user->id, 'newest' => true])->get(),
        ]);
    }

    public function store(Request $request) {
        $formFields['user_id'] = auth()->id();

        $order = Order::create($formFields);

        $formFields = $request->validate([
            'product_id' => ['required', 'numeric'],
            'count' => ['required', 'numeric'],
        ]);

        $formFields['order_id'] = $order->id;

        $orderitem = OrderItem::create($formFields);

        $total = Calculator::calculateTotal($order);
        
        $order->update(['total' => $total]);

        return back();
    }

    public function update(Request $request) {
        $orders = Order::own(['id' => auth()->id(), 'newest' => true])->get();

        if (is_null($orders->get(0))) {
            $this->store($request);
            return back();
        }

        $order = $orders[0];

        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'product_id' => ['required', 'numeric'],
            'count' => ['required', 'numeric'],
        ]);

        $formFields['order_id'] = $order->id;

        $toUpdate = false;
        foreach ($order->orderItems as $k => $item) {
            if ($item->product_id == request('product_id')) {
                $toUpdate = $k;
                break;
            }
        }

        if (is_numeric($toUpdate)) {
            $count = $order->orderItems[$toUpdate]->count + request('count');
            $orderitem = $order->orderItems[$toUpdate];
            $orderitem->update(['count' => $count]);
        } else {
            $orderitem = OrderItem::create($formFields);
        }

        $total = Calculator::calculateTotal($order);
        
        $order->update(['total' => $total]);

        return back();    
    }

    public function finish(Order $order, Request $request) {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'is_finished' => ['required'],
        ]);

        $order->update($formFields);

        return back();    
    }

    public function destroy(Order $order) {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($order->is_finished) {
            abort(409, 'Nem lehet törölni befejezett vásárlást');
        }

        $order->delete();
        
        return back();
    }

    public function destroyItem(Order $order, OrderItem $orderitem) {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($order->is_finished) {
            abort(409, 'Nem lehet törölni befejezett vásárlást');
        }

        $orderitem->delete();
        
        return back();
    }

    public function updateItem(Order $order, OrderItem $orderitem) {
        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($order->is_finished) {
            abort(409, 'Nem lehet módosítani befejezett vásárlást');
        }

        $formFields = request()->validate([
            'count' => ['required', 'numeric'],
        ]);

        $orderitem->update($formFields);

        $total = Calculator::calculateTotal($order);
        
        $order->update(['total' => $total]);
        
        return back();
    }
}
