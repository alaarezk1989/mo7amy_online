<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::enableForeignKeyConstraints();
        Schema::create('user_specialty', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->string('specialty');
            $table->timestamps();


        });

        // Schema::table('user_specialty', function($table){
        //           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_specialty');
    }
}
