<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->string('description');
            $table->tinyInteger('checked');
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
        Schema::dropIfExists('payment_groups');
    }
}
