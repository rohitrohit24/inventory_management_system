<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_redirect()
    {
        return view('admin.partial.sales');
    }
    public function sales_items_page_redirect()
    {
        return view('admin.partial.sales_items');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (empty($request->input('product_data'))) {
            return back()->with('error', 'Please add at least one product to generate an invoice.');
        }

        Sale::create([
            'invoice_no' => $request->invoice_no,
            'user_id' => $request->user_id,
            'customer_name' => $request->customer_name,
            'sale_date' => $request->sale_date,
            'discount' => $request->discount ?? 0,
            'grand_total' => $request->grand_total,
            'payment_method' => $request->payment_method,
            'products' => $request->input('product_data'),
        ]);
        return back()->with('message', 'sales store successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
