<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToProductPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_purchases', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class, 'user_id')->after('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_purchases', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['user_id']);
            // 2. Drop the column
            $table->dropColumn('user_id');
        });
    }
}
