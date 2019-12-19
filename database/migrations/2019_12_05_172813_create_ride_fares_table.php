<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_fares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ride_type_id');
            $table->integer('base_fare')->default(200);
            $table->integer('distance')->default(150);
            $table->integer('time')->default(100);
            $table->integer('wait_per_minute')->default(20);
            $table->integer('delivery_fare')->default(200);
            $table->integer('weight')->default(150);
            $table->integer('size')->default(50);
            $table->integer('value')->default(100);
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
        Schema::dropIfExists('ride_fares');
    }
}
