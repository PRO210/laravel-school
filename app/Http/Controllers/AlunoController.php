<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAluno;
use App\Models\Aluno;
use App\Models\Classificacao;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    private $repository, $classificacao;

    public function __construct(Aluno $aluno, Classificacao $classificacao, Documento $documento)
    {
        $this->repository = $aluno;
        $this->classificacao = $classificacao;
        $this->documento = $documento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $alunos = $this->repository->latest()->paginate(8);
        $alunos = DB::table('alunos')->orderBy('NOME', 'ASC')->paginate(8);

        return view('alunos.index', compact('alunos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAluno $request)
    {
        $aluno = $this->repository->create($request->all());

        return redirect()->route('alunos.index')->with('message', 'Operação Realizada com Sucesso!');;
        // return redirect()->action('Alunos\AlunoController@cursando', ['id' => '0'])->with('msg', 'Alterações Salvas com Sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $aluno = $this->repository->where('uuid', $uuid)->first();

        $documentos = $this->documento->all();

        return view('alunos.edit', compact('aluno', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $alunos = $this->repository->where('uuid', $uuid)->first();

        $backup = $this->repository->find($alunos->id);

        $alunos->update($request->except('_token', '_method'));

        $backup_update = $this->repository->find($alunos->id);

        $result = array_diff_assoc($backup_update->toArray(), $backup->toArray());
        $campo = "";
        $campo_final = "";

        foreach ($result as $nome_campo => $valor) {
            if ($backup[$nome_campo] == "") {
                $backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
            $campo .= "$nome_campo = De $backup[$nome_campo] para $valor / ";
        }
        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $campo ";

        $usuario = Auth::user()->id;
        DB::table('aluno_log')->insert(
            ['aluno_id' => $alunos->id, 'ACAO' => 'EDITAR' , 'ACAO_DETALHES' => $campo_final,'user_id' => $usuario,]
        );

        return redirect()->route('alunos.index')->with('message', 'Operações Realizadas com Sucesso!');
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
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $alunos = $this->repository->search($request->filter);

        return view('alunos.index', [
            'alunos' => $alunos,
            'filters' => $filters,
        ]);
    }
}
