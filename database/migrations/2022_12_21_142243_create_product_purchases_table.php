<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignIdFor(\App\Models\Suppliers::class, 'suppliers_id');
            $table->foreignIdFor(\App\Models\Address::class, 'address_id');
            $table->text('products');
            $table->double('price_vat');
            $table->double('price_total');
            $table->string('status');
            $table->string('financialStatus');
            $table->text('financialInfo');
            $table->string('receiveStatus');
            $table->string('reference');
            $table->dateTime('dueOn');
            $table->text('note');
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
        Schema::dropIfExists('product_purchases');
    }
}
