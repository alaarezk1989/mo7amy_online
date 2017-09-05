<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            
            $table->string('GUID');
            $table->string('user_GUID');
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->integer('country');
            $table->integer('city');
            $table->string('finished_date');
            $table->integer('status');
            $table->integer('is_bids')->default(0);
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
        Schema::dropIfExists('cases');
    }
}
