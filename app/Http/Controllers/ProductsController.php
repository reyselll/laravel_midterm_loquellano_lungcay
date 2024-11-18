<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prod_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        $product = new Product();
        $product->prod_name = $request->input('prod_name');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->image_path = $imagePath;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'prod_name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Optional image update
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image_path = $imagePath; // Update image
        }

        // Update product data
        $product->update($request->only(['prod_name', 'quantity', 'price'])); // Only update these fields

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
