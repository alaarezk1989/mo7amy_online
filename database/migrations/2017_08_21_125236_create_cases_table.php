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

            $table->string('id')->primary()->index();
            $table->string('user_id');
            $table->string('title');
            $table->string('description');
            $table->integer('city');
            $table->integer('section_id');
            $table->string('finished_date');
            $table->integer('status');
            $table->integer('is_bids')->default('0');
            $table->integer('view_count')->default(0);
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
