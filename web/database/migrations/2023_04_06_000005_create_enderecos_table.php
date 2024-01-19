<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cep')->nullable();
            $table->string('rua');
            $table->integer('numero')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->timestamps();
        });
    }
}
