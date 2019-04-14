<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PingData extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ping_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('raw_data');
            $table->string('server', 15);
            $table->tinyinteger('packet_count');
            $table->tinyinteger('packet_received');
            $table->tinyinteger('packet_loss');
            $table->decimal('rtt_min', 6, 3);
            $table->decimal('rtt_max', 6, 3);
            $table->decimal('rtt_avg', 6, 3);
            $table->decimal('rtt_mdev', 6, 3);
            $table->decimal('ipg', 6, 3);
            $table->decimal('ewma', 6, 3);
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
        Schema::drop('ping_datas');
    }

}
