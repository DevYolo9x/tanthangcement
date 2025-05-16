<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolylangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polylangs', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->integer('module_id');
            $table->integer('vi');
            $table->integer('en');
            $table->integer('tl');
            $table->integer('gm');
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
        Schema::dropIfExists('polylangs');
    }
}
