<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer("client_id")->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer("created_by")->nullable();
            $table->string("message");
            $table->boolean("read");
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
        Schema::dropIfExists('notifications');
    }
}
