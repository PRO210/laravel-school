<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aluno_id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->string('ACAO')->nullable();
            $table->string('ACAO_DETALHES')->nullable();
            $table->timestamps();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_log');
    }
}
