<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Classificacao;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;

class TurmaAlunoController extends Controller
{
    private $aluno, $turma;

    public function __construct(Turma $turma, Aluno $aluno, Classificacao $classificacao)
    {
        $this->turma = $turma;
        $this->aluno = $aluno;
        $this->classificacao = $classificacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunoTurmas = $this->aluno->correntTurmas();

        $classificacoes = $this->classificacao->get();

        return view('turmas.alunos.index', compact('alunoTurmas', 'classificacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $alunoTurmas = $this->aluno->with(['turmas'])->where('uuid', $uuid)->get();
        //dd($alunoTurmas);
        $aluno = $this->aluno->where('uuid', $uuid)->first();

        $turmas = $aluno->turmasAvailable();

        $classificacoes = $this->classificacao->get();

        return view('turmas.alunos.show', compact('turmas', 'alunoTurmas', 'aluno', 'classificacoes'));
    }

    /**c
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Atualiza os vínculos das turmas e alunos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attachTurmasAluno(Request $request, $uuid)
    {
        $aluno = $this->aluno->where('uuid', $uuid)->first();

        if ($request->salvar == "salvar") {
            $attach = $this->aluno->attach($request, $aluno);
            return redirect()->action('TurmaAlunoController@show', ['uuid' => $uuid])->with('message', 'Operação Realizada com Sucesso!');
        } else {
            $detach = $this->aluno->detach($request, $aluno);
            // return redirect()->route('turmas.index')->with('message', 'Operação Realizada com Sucesso!');
            return redirect()->action('TurmaAlunoController@show', ['uuid' => $uuid])->with('message', 'Operação Realizada com Sucesso!');

        }
    }
}
