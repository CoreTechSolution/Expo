<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('event_vertical_id');
            $table->string('event_title');
            $table->string('event_headline',100);
            $table->string('slug');
            $table->text('event_description')->nullable();
            $table->string('event_date');
            $table->string('event_time');
            $table->string('event_location')->nullable();
            $table->string('event_country')->nullable();
            $table->string('event_city')->nullable();
            $table->integer('attendees')->nullable();
            $table->integer('exhibitors')->nullable();
            $table->string('event_url')->nullable();
            $table->string('event_phone')->nullable();
            $table->string('event_email')->nullable();
            $table->integer('created_by');
            $table->integer('is_top');
            $table->integer('is_featured');
            $table->enum('status', ['1', '2','3']);
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
        Schema::dropIfExists('events');
    }
}
