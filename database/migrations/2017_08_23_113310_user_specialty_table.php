<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      //  Schema::enableForeignKeyConstraints();
    public function up()
    {

        Schema::table('user_specialty', function (Blueprint $table) {
          // Schema::enableForeignKeyConstraints();
         $table->string('id');

      // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_specialty', function (Blueprint $table) {
          // $table->dropForeign(['user_id']);
        });
    }
}
