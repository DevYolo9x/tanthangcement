<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Address::class, 'address_id');
            $table->string('code');
            $table->string('module');
            $table->integer('module_id');
            $table->foreignIdFor(\App\Models\PaymentGroups::class, 'group_id');
            $table->double('price');
            $table->string('type');
            $table->string('reference');
            $table->text('description');
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
        Schema::dropIfExists('payment_vouchers');
    }
}
