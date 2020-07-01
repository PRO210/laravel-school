<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoTurmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_turma', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('classificacao_id')->unsigned();

            $table->date('TURMA_ANO');
            $table->string('OUVINTE')->nullable();
            $table->string('EXCLUIDO')->default('NAO');
            $table->string('EXCLUIDO_PASTA')->nullable();
            $table->string('ATA')->nullable();
            $table->timestamps();

            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('classificacao_id')->references('id')->on('classificacaos');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_turma');
    }
}
