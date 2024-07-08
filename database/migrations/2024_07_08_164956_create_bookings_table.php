<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('facility_id')->constrained('storage_facilities')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('slots');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('info');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}


