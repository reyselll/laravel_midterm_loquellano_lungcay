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
            'amount' => 'required|integer',
            'price' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $imagePath = $request->file('image')->store('product_images', 'public');

        $product = new Product();
        $product->prod_name = $request->input('prod_name');
        $product->amount = $request->input('amount');
        $product->price = $request->input('price');
        $product->image_path = $imagePath; // Save the image path

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
        $validate = $request->validate([
            'prod_name' => 'sometimes|required|string|max:255' . $id,
            'amount' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validate);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
