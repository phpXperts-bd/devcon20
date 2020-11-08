<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressAndHashCodeColumnsInAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendees', function (Blueprint $table) {
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->uuid('hash_code')->nullable();
            $table->timestamp('hash_code_duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendees', function (Blueprint $table) {
            $table->dropColumn('address_line_1');
            $table->dropColumn('address_line_2');
            $table->dropColumn('city');
            $table->dropColumn('district');
            $table->dropColumn('hash_code');
            $table->dropColumn('hash_code_duration');
        });
    }
}
