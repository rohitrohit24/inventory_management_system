<?php

use App\Http\Controllers\AdminShowController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Purchase_itemsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TotalInvoiceController;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['admin.auth'])->group(function () {
    // Route::redirect('settings', 'settings/profile');
    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    // Volt::route('settings/password', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get('admin/show', [AdminShowController::class, 'show'])->name('admin.show');
    Route::get('dashboard/view', function () {
        return view('admin.partial.dashboard');
    })->name('dashboard.view');
    // categories ->

    Route::prefix('categorie/')->controller(CategoriesController::class)->name('categorie.')->group(function () {
        Route::get('view', 'page_redirect')->name('view');
        Route::get('index', 'index')->name('index');
        Route::post('store',  'store')->name('store');
    });

    // products ->

    Route::prefix('product/')->controller(ProductController::class)->name('product.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'page_redirect')->name('view');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::get('destroy', 'destroy')->name('destroy');
        Route::get('create', 'create')->name('create');
    });
    Route::prefix('supplier/')->controller(SupplierController::class)->name('supplier.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'page_redirect')->name('view');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::get('destroy', 'destroy')->name('destroy');
    });
    Route::prefix('supplier/')->controller(SupplierController::class)->name('supplier.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'page_redirect')->name('view');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::get('destroy', 'destroy')->name('destroy');
    });
    Route::prefix('totalinvoice/')->controller(TotalInvoiceController::class)->name('totalinvoice.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'page_redirect')->name('view');
        Route::get('add_product', 'add_product_redirect')->name('add_product');
        Route::get('paid_invoice', 'paid_inovice_redirect')->name('paid_invoice');
        Route::get('unpaid_invoice', 'unpaid_inovice_redirect')->name('unpaid_invoice');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::get('destroy', 'destroy')->name('destroy');
    });
    Route::prefix('sales/')->controller(SalesController::class)->name('sales.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'page_redirect')->name('view');
        Route::get('items', 'sales_items_page_redirect')->name('items');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::get('destroy', 'destroy')->name('destroy');
    });
});
Route::post('admin/auth', [AdminLoginController::class, 'login'])->name('admin.auth');
Route::get('admin/login', [AdminLoginController::class, 'showview'])->name('admin.login');

require __DIR__ . '/auth.php';
