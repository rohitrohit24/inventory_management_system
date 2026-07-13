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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories');
            $table->string('name', 255)->nullable();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable();
            $table->string('image')->nullable();
            $table->decimal('cost_price')->nullable();
            $table->decimal('selling_price')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('alert_quantity')->default(5);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
