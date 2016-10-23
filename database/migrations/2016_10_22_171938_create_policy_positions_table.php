<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('policy_id')->unsigned();
            $table->foreign('policy_id')->references('id')->on('policies');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
            $table->boolean('has_strong_vote')->nullable();
            $table->boolean('absent')->nullable();
            $table->boolean('both_voted')->nullable();
            $table->double('distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('policy_positions');
    }
}
