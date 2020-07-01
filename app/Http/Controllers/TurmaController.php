<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTurma;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    private $repository;

    public function __construct(Turma $turma)
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

        return view('turmas.index',compact('turmas') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('turmas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTurma $request)    {

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

        $turmas = $this->repository->search($request->filter);

        return view('turmas.index', [
            'turmas' => $turmas,
            'filters' => $filters,
        ]);
    }
}
