<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\TotalInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminShowController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();

        $stats = [
            'total_products'   => Product::count(),
            'total_categories' => Categorie::count(),
            'total_suppliers'  => Supplier::count(),
            'total_invoices'   => TotalInvoice::count(),
            'paid_invoices'    => TotalInvoice::where('due_amount', '<=', 0)->count(),
            'unpaid_invoices'  => TotalInvoice::where('due_amount', '>', 0)->count(),
            'total_stock'      => Product::sum('quantity'),
            'recent_products'  => Product::with('category')->latest()->take(5)->get(),
        ];

        return view('admin.partial.dashboard', compact('admin', 'stats'));
    }
}

