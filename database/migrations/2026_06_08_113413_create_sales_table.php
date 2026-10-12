<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->index();
            $table->string('customer_name')->nullable();
            $table->foreignId('user_id')->constrained()->comment('Staff/Admin ID');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('item_total', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->string('payment_method')->default('Cash');
            $table->date('sale_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
