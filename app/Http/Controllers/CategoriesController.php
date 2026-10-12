<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_redirect()
    {
        return view('admin.partial.categorie');
    }
    public function index()
    {
        return view('admin.partial.categorie');
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
        try {
            // Naya object banaya
            $categorie = new Categorie();

            // Ek-ek karke values assign ki
            $categorie->name = $request->name;
            $categorie->description = $request->description;

            // Database me save kiya
            $categorie->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Category successfully created!',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
        // return redirect(route('categorie.index'))->with('message', 'Category Store Successfully..');
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
