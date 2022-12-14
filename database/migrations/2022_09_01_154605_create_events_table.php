<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('entry_type');
            $table->integer('venue')->reference("id")->on("venues");;
            $table->string('city');
            $table->string('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('occurrence');
            $table->longText('description');
            $table->string('cover_image');
            $table->string('video_link');
            $table->string('event_type');
            $table->text('abilities')->nullable();
            $table->text('slug');
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
