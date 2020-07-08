<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['TURMA', 'TURMA_EXTRA', 'CATEGORIA', 'TURNO', 'UNICO', 'STATUS', 'ANO', 'TURMA_IDADE_MINIMA'];

    public function search($filter = null)
    {
        $results = $this->where('TURMA', 'LIKE', "%{$filter}%")
            ->paginate(10);

        return $results;
    }
    /*
     Traz os alunos cadastrados na turma
    */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'aluno_turma')->withPivot([
            'OUVINTE', 'classificacao_id', 'turma_id', 'aluno_id', 'DECLARACAO',
            'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA', 'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL'
        ]);
    }
}
