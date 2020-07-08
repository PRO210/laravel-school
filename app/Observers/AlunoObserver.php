<?php

namespace App\Observers;

use App\Models\Aluno;
use Illuminate\Support\Str;

class AlunoObserver
{
    /**
     * Handle the aluno "created" event.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return void
     */
    public function creating(Aluno $aluno)
    {
        $aluno->uuid = Str::uuid();
    }

    /**
     * Handle the aluno "updated" event.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return void
     */
    public function updating(Aluno $aluno)
    {
        // $aluno->uuid = Str::uuid();
    }

    /**
     * Handle the aluno "deleted" event.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return void
     */
    public function deleted(Aluno $aluno)
    {
        //
    }

    /**
     * Handle the aluno "restored" event.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return void
     */
    public function restored(Aluno $aluno)
    {
        //
    }

    /**
     * Handle the aluno "force deleted" event.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return void
     */
    public function forceDeleted(Aluno $aluno)
    {
        //
    }
}
