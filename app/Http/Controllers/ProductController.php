<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() {
        return Inertia::render('Products/List', [
            'products' => Product::latest()->get(),
        ]);
    }

    public function show(Product $product) {
        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }

    public function store( Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'price_1' => ['required', 'numeric'],
            'price_3' => ['required', 'numeric'],
            'price_5' => ['required', 'numeric'],
        ]);

        $formFields['user_id'] = auth()->id();

        $product = Product::create($formFields);

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product) {
        if ($product->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'price_1' => ['required', 'numeric'],
            'price_3' => ['required', 'numeric'],
            'price_5' => ['required', 'numeric'],
        ]);

        $product->update($formFields);

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);    
    }

    public function destroy(Product $product) {
        if ($product->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $product->delete();
        
        return Inertia::render('Products/List', [
            'products' => Product::latest()->get(),
        ]);    
    }
}
