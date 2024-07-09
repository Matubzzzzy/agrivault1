<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalSlotsAndPriceToStorageFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storage_facilities', function (Blueprint $table) {
            $table->integer('total_slots')->after('slots_available'); // Adjust the 'after' column as necessary
            $table->decimal('price', 10, 2)->after('total_slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storage_facilities', function (Blueprint $table) {
            $table->dropColumn('total_slots');
            $table->dropColumn('price');
        });
    }
}

