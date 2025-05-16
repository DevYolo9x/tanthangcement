<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Address::class, 'address_id');
            $table->string('code');
            $table->string('module');
            $table->integer('module_id');
            $table->foreignIdFor(\App\Models\ReceiptGroups::class, 'group_id');
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
        Schema::dropIfExists('receipt_vouchers');
    }
}
