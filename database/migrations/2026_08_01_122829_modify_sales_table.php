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
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);
            $table->string('products')->after('sale_date')->nullable();

            $table->dropColumn([
                'product_id',
                'category_id',
                'quantity',
                'unit_price',
                'tax',
                'item_total'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
};
