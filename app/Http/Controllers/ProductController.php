<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index() {
        return view('listings.index', [
            'listings' => Product::latest()->paginate(2)
        ]);
    }

    public function show(Product $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create() {
        return view('listings.create', [
        ]);
    }

    public function store( Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'website' => 'required',
            'description' => 'required',
            'location' => 'required',
            'tags' => 'required',
            'email' => ['required', 'email']
        ]);

        $formFields['user_id'] = auth()->id();

        Product::create($formFields);

        return redirect('/')->with('message', 'Product created');
    }

    public function edit(Product $listing) {
        return view('listings.edit', [
            'listing' => $listing,
        ]);
    }

    public function update(Request $request, Product $listing) {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'website' => 'required',
            'description' => 'required',
            'location' => 'required',
            'tags' => 'required',
            'email' => ['required', 'email'],

        ]);

        $listing->update($formFields);

        return back()->with('message', 'Product updated');
    }

    public function destroy(Product $product) {
        if ($product->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $product->delete();
        
        return redirect('/')->with('message', 'Product deleted');
    }
}
