<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer("ticket_id")->unsigned();
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->integer("status_id");
            $table->foreign('status_id')->references('id')->on('status_tickets');
            $table->longText("description");
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
        Schema::dropIfExists('follow_tickets');
    }
}
