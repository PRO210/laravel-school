<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTurma;
use App\Models\Category;
use App\Models\Shift;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    private $repository, $category, $shift;

    public function __construct(Turma $turma, Category $category, Shift $shift)
    {
        $this->repository = $turma;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = $this->repository->latest()->paginate();
        $categories = Category::all();

        return view('turmas.index', compact('turmas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $shifts = Shift::all();

        return view('turmas.create', compact(['categories','shifts']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTurma $request)
    {
        $turma = $this->repository->create($request->all());

        return redirect()->route('turmas.index');
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
        $turmas = $this->repository->find($id);
        $shifts = Shift::all();
        $categories = Category::all();

        return view('turmas.edit', compact('turmas', 'categories','shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTurma $request, $id)
    {
        if ($request->botao == "excluir") {
            return redirect()->action('TurmaController@delete', ['id' => $id]);
        }

        $turma = $this->repository->where('id', $id)->first();

        $turma->update($request->except('_token', '_method'));

        return redirect()->action('TurmaController@index')->with('message', 'Operação Realizada com Sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $turma = $this->repository->with('alunos')->where('id', $id)->first();

        if ($turma->alunos->count() > 0) {
            return redirect()->back()->with('error', 'Existem Alunos vinculados a essa Turma, portanto não permitido Deletar');
        }

        $turma->delete();

        return redirect()->action('TurmaController@index')->with('message', 'Operação Realizada com Sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $turmas = $this->repository->search($request->filter);

        return view('turmas.index', [
            'turmas' => $turmas,
            'filters' => $filters,
        ]);
    }
}
