<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_facts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('key');
            $table->index('key');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_facts');
    }
}
