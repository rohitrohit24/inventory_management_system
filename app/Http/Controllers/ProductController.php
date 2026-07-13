<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_redirect()
    {
        return view('admin.partial.product');
    }
    public function index()
    {
        $product = Product::all();
        return view('admin.partial.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        // $request->validated();

        $img = $request->file('image');
        $file_name = time() . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
        $file_path = $img->storeAs('ProductImg', $file_name, 'public');
        $product->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'quantity' => $request->quantity,
            'cost_price' => $request->cost_price,
            'tax_rate' => $request->tax_rate,
            'selling_price' => $request->selling_price,
            'alert_quantity' => $request->alert_quantity,
            'description' => $request->description,
            'image' => $file_path,
        ]);
        return redirect(route('product.index'))->with('message', 'Product Store Successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $img = $request->file('image');
        $file_name = time() . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
        $file_path = $img->storeAs('ProductImg', $file_name, 'public');
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'quantity' => $request->quantity,
            'cost_price' => $request->cost_price,
            'tax_rate' => $request->tax_rate,
            'selling_price' => $request->selling_price,
            'alert_quantity' => $request->alert_quantity,
            'description' => $request->description,
            'image' => $file_path,
        ]);
        return redirect(route('product.index'))->with('message', 'Product Update Successfully..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect(route('product.index'))->with('message', 'Product Destroy Successfully...');
    }
}
