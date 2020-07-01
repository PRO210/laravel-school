<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('INEP')->nullable();
            $table->string('PRIMEIRO_NOME')->nullable();;
            $table->string('NOME');
            $table->date('NASCIMENTO')->nullable();
            $table->string('CERTIDAO_CIVIL')->nullable();
            $table->string('MODELO_CERTIDAO')->nullable();
            $table->string('MATRICULA_CERTIDAO')->nullable();
            $table->string('DADOS_CERTIDAO')->nullable();
            $table->string('NUMERO_RG')->nullable();
            $table->string('CPF')->nullable();
            $table->string('ORGAO_EXPEDIDOR_RG')->nullable();
            $table->date('EXPEDICAO_CERTIDAO')->nullable();
            $table->string('NATURALIDADE')->nullable();
            $table->string('ESTADO')->nullable();
            $table->string('NACIONALIDADE')->nullable();
            $table->string('SEXO')->nullable();
            $table->string('NIS')->nullable();
            $table->string('BOLSA_FAMILIA')->nullable();
            $table->string('SUS')->nullable();
            $table->string('NECESSIDADES_ESPECIAIS')->nullable();
            $table->string('NECESSIDADES_ESPECIAIS_DESCRICACAO')->nullable();
            $table->string('NECESSIDADES_ESPECIAIS_CODIGO')->nullable();
            $table->string('COR')->nullable();
            $table->string('FONE')->nullable();
            $table->string('FONE_II')->nullable();
            $table->string('EMAIL')->unique()->nullable();
            $table->string('MAE')->nullable();
            $table->string('PROF_MAE')->nullable();
            $table->string('PAI')->nullable();
            $table->string('PROF_PAI')->nullable();
            $table->string('ENDERECO')->nullable();
            $table->string('URBANO')->nullable();
            $table->string('CIDADE')->nullable();
            $table->string('CIDADE_ESTADO')->nullable();
            $table->string('TRANSPORTE')->nullable();
            $table->string('PONTO_ONIBUS')->nullable();
            $table->string('MOTORISTA')->nullable();
            $table->string('MOTORISTA_II')->nullable();
            $table->string('OBSERVACOES')->nullable();
            $table->string('EXCLUIDO')->default('NAO');
            $table->string('EXCLUIDO_PASTA')->nullable();
            $table->text('ATUALIZACOES')->nullable();
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
        Schema::dropIfExists('alunos');
    }
}
