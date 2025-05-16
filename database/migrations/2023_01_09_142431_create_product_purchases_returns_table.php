<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchases_returns', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->string('method');
            $table->text('note');
            $table->text('products');
            $table->foreignIdFor(\App\Models\ProductPurchase::class, 'product_purchases_id');
            $table->foreignIdFor(\App\Models\User::class, 'userid_created');
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
        Schema::dropIfExists('product_purchases_returns');
    }
}
