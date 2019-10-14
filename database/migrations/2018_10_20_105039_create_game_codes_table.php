<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('game_code');
            $table->string('game_type');
            $table->string('game_odd');
            $table->integer('tag')->unsigned(); 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_codes');
    }
}
