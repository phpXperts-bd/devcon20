<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('recording_url');
            $table->text('description');
            $table->json('speakers')->nullable();
            $table->string('slide_url')->nullable();
            $table->string('codebase_url')->nullable();
            $table->boolean('active')->default(1);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->smallInteger('chatroom_id')->default(1);
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
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
        Schema::dropIfExists('sessions');
    }
}
