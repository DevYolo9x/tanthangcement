<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class, 'product_id');
            $table->tinyInteger('publish');
            $table->foreignIdFor(\App\Models\User::class, 'userid_created');
            $table->foreignIdFor(\App\Models\User::class, 'userid_updated');
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
        Schema::dropIfExists('product_deals');
    }
}
