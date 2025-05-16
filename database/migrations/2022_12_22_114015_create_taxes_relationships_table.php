<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class, 'product_id');
            $table->float('taxes_import');
            $table->float('taxes_export');
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
        Schema::dropIfExists('taxes_relationships');
    }
}
