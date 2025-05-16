<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->nullable();
            $table->foreignIdFor(\App\Models\SuppliersCategory::class, 'category_id');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('label')->nullable();
            $table->string('address');
            $table->foreignIdFor(\App\Models\VNCity::class, 'city_id')->nullable();
            $table->foreignIdFor(\App\Models\VNDistrict::class, 'district_id')->nullable();
            $table->foreignIdFor(\App\Models\VNWard::class, 'ward_id')->nullable();
            $table->string('fax')->nullable();
            $table->string('taxNumber')->nullable();
            $table->string('website')->nullable();
            $table->double('debt')->nullable();
            $table->text('description')->nullable();
            $table->text('payment')->nullable();
            $table->tinyInteger('publish');
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
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
        Schema::dropIfExists('suppliers');
    }
}
