<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMovimentacoesTable extends Migration
{
    public function up()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            $table->unsignedBigInteger('conta_id');
            $table->foreign('conta_id', 'conta_fk_8293098')->references('id')->on('conta')->onDelete('cascade');
        });
    }
}
