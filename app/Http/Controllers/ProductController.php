<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',   compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
   
        $product = Product::create([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);
        return redirect()->route('products.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
            
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // Collect only the fields that are present in the request
        $data = $request->only(['name', 'detail']);
    
        // Update the product with the provided data
        $product->update($data);
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
        // Redirect to the product's detail page with a success message
        // return redirect()->route('products.show', $product)->with('success', 'Product updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
