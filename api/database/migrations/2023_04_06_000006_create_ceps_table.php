<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepsTable extends Migration
{
    public function up()
    {
        Schema::create('ceps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cep');
            $table->string('rua');
            $table->string('cidade');
            $table->string('estado')->nullable();
            $table->timestamps();
        });
    }
}
