<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchases_items', function (Blueprint $table) {
            $table->id();
            $table->string('rowid');
            $table->foreignIdFor(\App\Models\ProductPurchase::class, 'product_purchases_id');
            $table->foreignIdFor(\App\Models\Product::class, 'product_id');
            $table->string('product_version')->nullable();
            $table->tinyInteger('quantity');
            $table->tinyInteger('quantity_return')->nullable();
            $table->double('price');
            $table->double('price_taxes');
            $table->double('taxes_import');
            $table->string('taxes_type');
            $table->double('taxes_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_purchases_items');
    }
}
