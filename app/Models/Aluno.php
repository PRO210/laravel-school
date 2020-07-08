<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turma;
use App\Observers\AlunoObserver;
use Illuminate\Support\Facades\DB;
use App\Models\Classificacao;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class Aluno extends Model
{
    protected $fillable =
    [
        'NOME', 'NASCIMENTO', 'uuid', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO', 'EXPEDICAO_CERTIDAO', 'NUMERO_RG', 'ORGAO_EXPEDIDOR_RG', 'EXPEDICAO_RG', 'CPF', 'NATURALIDADE', 'ESTADO', 'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'NECESSIDADES_ESPECIAIS_DESCRICACAO', 'NECESSIDADES_ESPECIAIS_CODIGO', 'COR', 'FONE', 'FONE_II', 'EMAIL', 'MAE', 'PROF_MAE', 'PAI', 'PROF_PAI', 'ENDERECO', 'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'OBSERVACOES', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'ATUALIZACOES'
    ];

    public function search($filter = null)
    {
        $results = $this->where('NOME', 'LIKE', "%{$filter}%")->paginate(10);

        return $results;
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'aluno_turma')->withPivot([
            'OUVINTE', 'classificacao_id', 'turma_id', 'aluno_id', 'DECLARACAO',
            'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA', 'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL'
        ]);
    }

    /*
    Listar as turmas do ano corrente
     */
    public function correntTurmas()
    {
        $alunos = DB::table('aluno_turma')
            ->where('aluno_turma.EXCLUIDO', 'LIKE', 'NAO')
            ->whereIn('aluno_turma.classificacao_id', [1, 2])
            ->join('alunos', 'aluno_turma.aluno_id', '=', 'alunos.id')
            ->join('turmas', 'aluno_turma.turma_id', '=', 'turmas.id')
            ->select('aluno_turma.aluno_id', 'alunos.NOME', 'aluno_turma.turma_id', 'aluno_turma.classificacao_id')
            ->orderBy('aluno_turma.turma_id', 'ASC')->orderBy('alunos.NOME', 'ASC')
            // ->toSql();
            ->get();
        //dd($alunos);

        $alunos_id[] = "";
        $turmas_id[] = "";
        foreach ($alunos as $dados) {
            foreach ($dados as $key => $value) {
                if ($key == "aluno_id") {
                    array_push($alunos_id, $value);
                }
                if ($key == "turma_id") {
                    array_push($turmas_id, $value);
                }
            }
        }
        array_shift($alunos_id);
        array_shift($turmas_id);

        $alunoTurmas = collect([]);
        foreach ($alunos_id as $key => $nulo) {
            $alunoTurmas = $alunoTurmas->concat(Aluno::with(['turmas' => function ($query) use ($turmas_id, $key) {
                $query->where('turma_id', $turmas_id[$key]);
            }])->where('id', $alunos_id[$key])->get());
        }
        return $alunoTurmas;
    }


    /*
    Recupera as turmas em que o aluno não está matriculado
    */
    public function turmasAvailable($filter = null)
    {

        $turmas = Turma::whereNotIn('id', function ($query) {
            $query->select('aluno_turma.turma_id');
            $query->from('aluno_turma');
            $query->whereRaw("aluno_turma.aluno_id={$this->id}");
        })
            // ->where(function ($queryFilter) use ($filter) {
            //     if($filter)
            //     $queryFilter->where('turmas.', 'LIKE', "%{$filter}%");
            // })
            // ->toSql();
            ->paginate();

        return $turmas;
    }

    public function attach($request, $aluno)

    {
        if (isset($request->turma_id)) {
            foreach ($request->turma_id as $turma) {
                $posionId = explode('/', $turma);
                $posion = $posionId[0];
                $turma_id = $posionId[1];;
                $aluno->turmas()->updateExistingPivot($turma_id, [
                    'classificacao_id' => $request->classificacao_id[$posion], 'OUVINTE' => $request->OUVINTE[$posion],
                    'DECLARACAO' => $request->DECLARACAO[$posion], 'DECLARACAO_DATA' => $request->DECLARACAO_DATA[$posion], 'DECLARACAO_RESPONSAVEL' => $request->DECLARACAO_RESPONSAVEL[$posion],
                    'TRANSFERENCIA' => $request->TRANSFERENCIA[$posion], 'TRANSFERENCIA_DATA' => $request->TRANSFERENCIA_DATA[$posion], 'TRANSFERENCIA_RESPONSAVEL' => $request->TRANSFERENCIA_RESPONSAVEL[$posion],'updated_at' => NOW()
                ]);
            }
        }

        if (isset($request->turma_id_02)) {
            foreach ($request->turma_id_02 as $turma) {
                $posionId = explode('/', $turma);
                $posion = $posionId[0];
                $turma_id = $posionId[1];;
                $aluno->turmas()->attach($turma_id, [
                    'classificacao_id' => $request->classificacao_id_02[$posion], 'OUVINTE' => $request->OUVINTE_02[$posion],
                    'DECLARACAO' => $request->DECLARACAO_02[$posion], 'DECLARACAO_DATA' => $request->DECLARACAO_DATA_02[$posion], 'DECLARACAO_RESPONSAVEL' => $request->DECLARACAO_RESPONSAVEL_02[$posion],
                    'TRANSFERENCIA' => $request->TRANSFERENCIA_02[$posion], 'TRANSFERENCIA_DATA' => $request->TRANSFERENCIA_DATA_02[$posion], 'TRANSFERENCIA_RESPONSAVEL' => $request->TRANSFERENCIA_RESPONSAVEL_02[$posion], 'updated_at' => NOW()
                ]);
            }
        }
    }

    public function detach($request, $aluno)
    {
        if (isset($request->turma_id)) {
            foreach ($request->turma_id as $turma) {
                $posionId = explode('/', $turma);
                $turma_id = $posionId[1];;
                $aluno->turmas()->detach($turma_id);
            }
        }
    }
}
