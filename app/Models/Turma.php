<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['TURMA', 'TURMA_EXTRA', 'CATEGORIA', 'TURNO', 'UNICO', 'STATUS','ANO','TURMA_IDADE_MINIMA'];

    public function search($filter = null)
    {
        $results = $this->where('TURMA', 'LIKE', "%{$filter}%")
                        ->paginate(10);

        return $results;
    }


}
