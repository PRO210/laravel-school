@extends('adminlte::page')

@section('title', 'Cadastrar Nova Turma')

@section('content_header')
<h1>Cadastrar Nova Turma</h1>
@stop

@section('content')
<div class="container-fluid">
    <form action="{{route('turmas.store')}}" method="post" >
        @csrf

            <div class="form-group row ">
                <label for="" class="col-sm-1 col-form-label">Nome</label>
                <div class="col-sm-5">
                <input type="text" name="TURMA" id="" class="form-control" placeholder="" required>
                </div>
                <label for="" class="col-sm-1 col-form-label">Único</label>
                <div class="col-sm-5">
                <input type="text" name="UNICO" id="" class="form-control" placeholder="" required>
                </div>
            </div>


            <div class="form-group row ">
                <label for="" class="col-sm-1 col-form-label">Turno</label>
                <div class="col-sm-5">
                <input type="text" name="TURNO" id="" class="form-control" placeholder="" required>
                </div>
                <label for="" class="col-sm-1 col-form-label">Categoria</label>
                <div class="col-sm-5">
                <input type="text" name="CATEGORIA" id="" class="form-control" placeholder="" required>
                </div>
            </div>

            <div class="form-group row ">
                <label for="" class="col-sm-1 col-form-label">ANO</label>
                <div class="col-sm-5">
                <input type="date" name="ANO" id="" class="form-control" placeholder="" required>
                </div>
                <label for="" class="col-sm-1 col-form-label">Idade Mínima</label>
                <div class="col-sm-5">
                <input type="number" name="TURMA_IDADE_MINIMA" id="" class="form-control" placeholder="" required>
                </div>
            </div>


            <div class="form-group row ">
                <label for="" class="col-sm-1 col-form-label">Turma Extra</label>
                <div class="col-sm-5">
                <input type="text" name="TURMA_EXTRA" id="" class="form-control" placeholder="" required>
                </div>
            </div>




        <div class="row">
            <div class="form-group row ">
                <div class="col-sm-5">
                     <button type="submit" class="btn btn-outline-success">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
