<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string("nome_completo");
            $table->date("nascimento");
            $table->string("nome_mae");
            $table->string("uf_nascimento");
            $table->string("rg");
            $table->string("cpf");
            $table->string("cep");
            $table->string("endereco");
            $table->string("bairro");
            $table->integer("numero")->nullable();
            $table->integer("complemento")->nullable();
            $table->string("cidade");
            $table->string("uf");
            $table->string("telefone");
            $table->string("celular");
            $table->string("email");
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
        Schema::dropIfExists('pessoas');
    }
}
