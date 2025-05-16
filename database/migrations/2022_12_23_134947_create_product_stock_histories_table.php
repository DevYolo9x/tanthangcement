<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class, 'product_id');
            $table->string('product_version_id');
            $table->foreignIdFor(\App\Models\Address::class, 'address_id');
            $table->foreignIdFor(\App\Models\ProductPurchase::class, 'purchase_id');
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->text('note');
            $table->integer('quantity');
            $table->text('type');
            $table->text('stock');
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
        Schema::dropIfExists('product_stock_histories');
    }
}
