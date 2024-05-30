<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_product_id');
            $table->string('ean');
            $table->string('model');
            $table->integer('warranty');
            $table->integer('handling_time');
            $table->string('name');
            $table->string('brand');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('subcat_id');
            $table->unsignedBigInteger('childcat_id');
            $table->decimal('sale_price', 10);
            $table->decimal('original_sale_price', 10)->nullable();
            $table->decimal('vat_rate', 5);
            $table->integer('stock');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('subcat_id')->references('id')->on('subcategories')->cascadeOnDelete();
            $table->foreign('childcat_id')->references('id')->on('childcategories')->cascadeOnDelete();
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
