<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoreProceedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $proceedure = "DROP PROCEDURE IF EXISTS `get_data_for_charts`;

            CREATE PROCEDURE `get_data_for_charts` ()

            BEGIN

            SELECT EXTRACT(MONTH FROM created_at) as month, COUNT(booking_id) as nos FROM bookings GROUP BY EXTRACT(MONTH FROM created_at) ORDER BY EXTRACT(MONTH FROM created_at);

            END;";

        DB::unprepared($proceedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_proceedure');
    }
}
