<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnderecosTable extends Migration
{
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->unsignedBigInteger('pessoa_id');
            $table->foreign('pessoa_id', 'pessoa_fk_8293050')->references('id')->on('pessoas')->onDelete('cascade');
        });
    }
}
