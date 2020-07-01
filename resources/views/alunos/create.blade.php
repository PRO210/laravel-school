@extends('adminlte::page')

@section('title', 'Cadastrar Novo Aluno(a)')

@section('content_header')
<h1>Cadastrar Novo Aluno(a)</h1>
@stop

@section('content')
<div class="container-fluid">
    <form action="{{route('aluno.store')}}" method="post" class="form">
        @csrf
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Nome do Aluno(a)</label>
                <div class="col-sm-4">
                <input type="text" name="NOME" id="" class="form-control" placeholder="" required>
                </div>
                <label for="" class="col-sm-2 control-label">Nascimento</label>
                <div class="col-sm-4">
                    <input type="date" name="NASCIMENTO" id="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <div class="col-sm-4">
                     <button type="submit" class="btn btn-outline-success">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
