<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_redirect()
    {
        return view('admin.partial.supplier');
    }
    public function index()
    {
        return view('admin.partial.supplier');
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
        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'gst_number' => $request->gst_number,
            'Status' => $request->status,
        ]);
        return redirect(route('supplier.index'))->with('message', 'Supplier Store Successfully...');
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
