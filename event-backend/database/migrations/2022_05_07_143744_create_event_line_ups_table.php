<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventLineUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_line_ups', function (Blueprint $table) {
            $table->id('event_line_up_id');
            $table->string('event_line_up_title');
            $table->time('event_line_up_start');
            $table->time('event_line_up_end');
            $table->integer('event_line_up_eventid');
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
        Schema::dropIfExists('event_line_ups');
    }
}
