<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContaTable extends Migration
{
    public function up()
    {
        Schema::create('conta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cpf');
            $table->string('conta')->unique();
            $table->timestamps();
        });
    }
}
