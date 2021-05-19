<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('cep'); //Código Postal
            $table->string('uf'); // Sigla do Estado
            $table->string('cidade'); // Nome da cidade
            $table->string('bairro'); // Comunidade ou Região de uma cidade
            $table->string('endereco'); // Logradouro
            $table->string('numero')->nullable(); // Número da residência caso exista (Não é obrigatório)
            $table->longText('complemento')->nullable(); // Complemento do endereço (Não é obrigatório)
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
        Schema::dropIfExists('addresses');
    }
}
