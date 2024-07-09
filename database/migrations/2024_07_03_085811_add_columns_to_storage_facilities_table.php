<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStorageFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('storage_facilities', function (Blueprint $table) {
            $table->string('county')->after('location');
            $table->integer('slots_available')->after('county');
            $table->string('image')->nullable()->after('total_slots'); // Assuming you store image path
        });
    }

    public function down()
    {
        Schema::table('storage_facilities', function (Blueprint $table) {
            $table->dropColumn('county');
            $table->dropColumn('slots_available');
            $table->dropColumn('image');
        });
    }
};
