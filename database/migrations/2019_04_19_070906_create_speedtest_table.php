<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeedtestTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speedtest', function (Blueprint $table) {
            $table->increments('id');
            $table->text('raw_data');
            $table->decimal('ping', 6, 3);
            $table->decimal('download', 5, 2);
            $table->decimal('upload', 5, 2);
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
        Schema::drop('speedtest');
    }

}
