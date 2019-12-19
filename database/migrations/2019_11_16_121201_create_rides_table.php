<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rider_id');
            $table->integer('user_id');
            $table->enum('type', ['1', '2'])->default('1');
            $table->string('code');
            $table->integer('origine');
            $table->integer('destination');
            $table->integer('package_id')->nullable();
            $table->integer('status');
            $table->text('price_range');
            $table->double('amount_paid')->nullable();
            $table->integer('bonus')->default(0);
            $table->integer('tips')->default(0);
            $table->string('currency')->default('Fc');
            $table->integer('number_of_people')->default(1);
            $table->double('distance')->default(0);
            $table->integer('duration')->default(0);
            $table->string('time_departure')->nullable();
            $table->string('time_arrive')->nullable();
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
        Schema::dropIfExists('rides');
    }
}
