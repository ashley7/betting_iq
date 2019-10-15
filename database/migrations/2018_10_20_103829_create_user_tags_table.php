<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('tag')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('paid')->default('not paid');
            $table->integer('safe_guard')->unsigned()->default(0);
            $table->decimal('amount',10,2)->default(0.00);
            $table->decimal('tax',3,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tags');
    }
}
