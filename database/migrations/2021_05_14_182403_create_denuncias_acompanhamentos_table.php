<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasAcompanhamentosTable extends Migration
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
            $table->integer("agente_id")->unsigned();
            $table->foreign('agente_id')->references('id')->on('agentes');
            $table->integer("denuncia_id")->unsigned();
            $table->foreign('denuncia_id')->references('id')->on('denuncias');
            $table->integer("status_id")->unsigned();
            $table->foreign('status_id')->references('id')->on('status_ocorrencias');
            $table->longText("descricao_acompamnhamento");
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
