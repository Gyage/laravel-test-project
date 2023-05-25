<?php

namespace App\Http\Controllers;

use App\Actions\App\OrderItemInsert;
use App\Actions\App\OrderTotalUpdate;
use App\Models\Order;
use App\Models\OrderItem;
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
            'order' => Order::own(['id' => $user->id, 'newest' => true])->get()->get(0),
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

        OrderItem::create($formFields);

        OrderTotalUpdate::execute($order);
        
        return back();
    }

    public function update(Request $request) {
        $order = Order::own(['id' => auth()->id(), 'newest' => true])->get()->get(0);

        if (is_null($order)) {
            $this->store($request);
            return back();
        }

        if ($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'product_id' => ['required', 'numeric'],
            'count' => ['required', 'numeric'],
        ]);
        $formFields['order_id'] = $order->id;

        OrderItemInsert::execute($order, $formFields);

        OrderTotalUpdate::execute($order);
        
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

        OrderTotalUpdate::execute($order);
                
        return back();
    }
}
