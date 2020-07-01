<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAluno;
use App\Models\Aluno;
use App\Models\Classificacao;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    private $repository, $classificacao;

    public function __construct(Aluno $aluno, Classificacao $classificacao)
    {
     $this->repository = $aluno;
     $this->classificacao = $classificacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->repository->latest()->paginate();


        return view('alunos.index',compact('alunos') );
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
    public function store(StoreUpdateAluno $request)    {

        $aluno = $this->repository->create($request->all());

        return redirect()->route('alunos.index');
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
