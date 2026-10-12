<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.partial.reports');
    }
    public function sales(Request $request)
    {
        $query = Sale::query()->orderBy('sale_date', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('sale_date', [$request->start_date, $request->end_date]);
        }

        $sales = $query->get();

        return view('admin.partial.reports', compact('sales'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
