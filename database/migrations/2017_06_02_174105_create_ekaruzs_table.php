<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkaruzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekaruzs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email')->unique();
            $table->string('street_address');
            $table->string('town_address');
            $table->string('state_address');
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
        Schema::dropIfExists('ekaruzs');
    }
}
