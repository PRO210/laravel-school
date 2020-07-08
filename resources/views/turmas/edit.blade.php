<script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Alterar Cadastro')

@section('content_header')
<h1>Alterar Cadastro</h1>
@stop
<style>
    input {
        text-transform: uppercase;
    }
</style>
@section('content')
<div class="container-fluid">
    <form action="{{route('turmas.update',$turmas->id)}}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group row ">
            <label for="" class="col-sm-1 col-form-label">Nome</label>
            <div class="col-sm-5">
                <input type="text" value="{{$turmas->TURMA}}" name="TURMA" id="" class="form-control" placeholder="" required>
            </div>
            <label for="" class="col-sm-1 col-form-label">Único</label>
            <div class="col-sm-5">
                <input type="text" value="{{$turmas->UNICO}}" name="UNICO" id="" class="form-control" placeholder="" required>
            </div>
        </div>

        <div class="form-group row ">
            <label for="" class="col-sm-1 col-form-label">Turno</label>
            <div class="col-sm-5">
                <select name="TURNO" id="" class=" form-control">
                    @foreach($shifts as $shift)
                    @if($shift->TURNO == "$turmas->TURNO")
                    <option value="{{$shift->TURNO}}" selected>{{$shift->TURNO}}</option>
                    @else
                    <option value="{{$shift->TURNO}}">{{$shift->TURNO}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <label for="" class="col-sm-1 col-form-label">Categoria</label>
            <div class="col-sm-5">
                <select id="" class=" form-control" name="CATEGORIA" required>
                    @foreach($categories as $category)
                    @if($category->CATEGORIA == "$turmas->CATEGORIA")
                    <option value="{{$category->CATEGORIA}}" selected>{{$category->CATEGORIA}}</option>
                    @else
                    <option value="{{$category->CATEGORIA}}">{{$category->CATEGORIA}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row ">
            <label for="" class="col-sm-1 col-form-label">ANO</label>
            <div class="col-sm-5">
                <input type="date" value="{{$turmas->ANO}}" name="ANO" id="" class="form-control" placeholder="" required>
            </div>
            <label for="" class="col-sm-1 col-form-label">Idade Mínima</label>
            <div class="col-sm-5">
                <input type="number" value="{{$turmas->TURMA_IDADE_MINIMA}}" name=" TURMA_IDADE_MINIMA" id="" class="form-control" placeholder="" required>
            </div>
        </div>

        <div class="form-group row ">
            <label for="" class="col-sm-1 col-form-label">Turma Extra</label>
            <div class="col-sm-5">
                <select name="TURMA_EXTRA" id="" name="TURMA_EXTRA" class="form-control" required>
                    @if($turmas->TURMA_EXTRA == "SIM")
                    <option value="SIM" selected>SIM</option>
                    <option value="NAO">NÃO</option>
                    @else
                    <option value="SIM">SIM</option>
                    <option value="NAO" selected>NÃO</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                    <button type="submit" name="botao" value="salvar" class="btn btn-outline-success btn-block">
                        <b>Salvar</b>
                    </button>
                </div>
                <div class="col-sm">
                    <button type="submit" name="botao" value="excluir" class="btn btn-outline-danger btn-block" onclick=" return confirmar()">
                        <b>Excluir</b>
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection
