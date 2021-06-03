<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->integer("crime_id")->unsigned();
            $table->foreign('crime_id')->references('id')->on('cybercrimes');
            $table->integer("pessoa_id")->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->integer("status_id")->unsigned();
            $table->foreign('status_id')->references('id')->on('status_ocorrencias');
            $table->datetime("datahora_ocorrencia");
            $table->longText("descricao_detalhada");
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
        Schema::dropIfExists('denuncias');
    }
}
