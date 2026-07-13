<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TotalInvoice;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class TotalInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_redirect()
    {
        return view('admin.partial.total_invoice');
    }
    public function add_product_redirect()
    {
        return view('admin.partial.add_invoice_product');
    }
    public function paid_inovice_redirect()
    {
        return view('admin.partial.paid_invoice');
    }
    public function unpaid_inovice_redirect()
    {
        return view('admin.partial.unpaid_invoice');
    }
    public function index()
    {
        $totalinvoice = TotalInvoice::all();
        return view('admin.partial.total_invoice', compact('totalinvoice'));
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
        TotalInvoice::create([
            'invoice_no'     => $request->input('invoice_no'),
            'supplier_id'    => $request->supplier_id,
            'purchases_date' => $request->purchases_date,
            'total_amount'   => $request->total_amount,
            'paid_amount'    => $request->paid_amount,
            'due_amount'     => $request->due_amount,
            'created_by'     => $request->created_by,
            'products'       => $request->input('product_data'),
            'status'         => $request->due_amount <= 0 ? '1' : '0',
        ]);
        $product_data = $request->input('product_data');
        $product_array = json_decode($product_data, true);
        foreach ($product_array as $product) {
            $productId = $product['productId'];
            $newquantity  = $product['quantity'];
            $findproduct = Product::find($productId);
            if ($findproduct) {
                $findproduct->increment('quantity', $newquantity);
            }
        }





        // $product_data = $request->input('product_data');

        // $product_array = json_decode($product_data, true);

        // if (!empty($product_array)) {
        //     foreach ($product_array as $product) {
        //         TotalInvoice::create([
        //             'invoice_no'   => $product['invoice_no'],
        //             'product_id'   => $product['productId'],
        //             'quantity'     => $product['quantity'],
        //             'cost_price'   => $product['cost_price']
        //         ]);
        //     }
        // }
        return redirect(route('totalinvoice.index'))->with('message', 'Invoice Store Successfully..');
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
