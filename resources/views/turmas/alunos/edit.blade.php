@extends('adminlte::page')

@section('title', 'alunos')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{ route('turmas.index') }}" class="">Turmas</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('turmas.alunos') }}" class=" active">Alunos Cursando</a></li>
</ol>

@stop

@section('content')

<!-- jQuery -->
<script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
@include('admin.includes.alerts')

<style>
    .paddingButton {
        border-color: aliceblue;
        padding: 0px;
    }

    .table td,
    .table th {
        padding: 8px;
    }

    .checkbox {
        display: inline-block;
    }
</style>

<div class="card">
    <div class="card-header">
        <button class="btn btn-warning ver" type="button" value="turmas">Turmas</button>
        <button class="btn btn-success ver" type="button" value="transferencias">Transferências</button>

        <form action="{{ route('turmas.aluno.update.bloco') }}" method="POST" class="form form-inline">
            @csrf
            <!-- <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}"> -->
            <!-- <button class="btn btn-warning" value="turmas">Turmas</button> -->
    </div>

    <div class="card-body">
        <div class="row justify-content-center" id="turmas" style="display: none;">
            <fieldset class="col-sm-12 col-md-12 px-6">
                <legend>
                    <select name="turma_id" id="" class=" form-control">
                        @foreach($turmas as $turma)
                        <option value="{{$turma->id}}">{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}
                        </option>
                        @endforeach
                    </select>
                </legend>
                <div class="row">
                    <label for="" class="col-sm-2 control-label">Ouvinte:</label>
                    <div class="col-sm-4">
                        <select name="OUVINTE" id="" class=" form-control">
                            <option value="NAO" selected>NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
                    </div>
                    <label for="" class="col-sm-2 control-label">Status:</label>
                    <div class="col-sm-4">
                        <select name="classificacao_id" id="" class=" form-control">
                            @foreach($classificacoes as $classificacao)
                            <option value="{{$classificacao->id}}">{{$classificacao->STATUS}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="" class="col-sm-2 control-label">Declaração:</label>
                    <div class="col-sm-4">
                        <select name="DECLARACAO" id="" class=" form-control">
                            <option value="NAO" selected>NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
                    </div>
                    <label for="" class="col-sm-2 control-label">Data:</label>
                    <div class="col-sm-4">
                        <input type="date" name="DECLARACAO_DATA" id="" class=" form-control">
                    </div>

                </div>
                <br>
                <div class="row">
                    <label for="" class="col-sm-2 control-label">Responsável:</label>
                    <div class="col-sm-10">
                        <input type="text" name="DECLARACAO_RESPONSAVEL" class=" form-control" placeholder="">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="" class="col-sm-2 control-label">Transferência:</label>
                    <div class="col-sm-4">
                        <select name="TRANSFERENCIA" id="" class=" form-control">
                            <option value="NAO" selected>NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
                    </div>
                    <label for="" class="col-sm-2 control-label">Data:</label>
                    <div class="col-sm-4">
                        <input type="date" name="TRANSFERENCIA_DATA" id="" class=" form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="" class="col-sm-2 control-label">Responsável:</label>
                    <div class="col-sm-10">
                        <input type="text" name="TRANSFERENCIA_RESPONSAVEL" class=" form-control" placeholder="">
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm">
                            <button type="submit" name="salvar" value="salvar" class="btn btn-outline-warning btn-block " onclick=" return confirmar() " title="Selecione ao menos uma turma">
                                <b>Adicionar / Salvar</b>
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div><br>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>NASCIMENTO</th>
                    <th>TURMA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno)
                @foreach ($aluno->turmas as $Key => $turma)
                @endforeach
                <tr>
                    <td>
                        <span><input type='checkbox' checked name='aluno_selecionado[]' class='checkbox' value='{{$aluno->uuid}}/{{$turma->id}}/{{$aluno->id}}'></span>
                        &nbsp;<span>{{ $aluno->NOME }}</span>
                    </td>
                    <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                    <td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>

                </tr>

                @endforeach

            </tbody>
        </table>
    </div>

    </form>

</div>


</div>
<!--Div Turmas-->
<script type="text/javascript">
    $(document).ready(function() {
        $('.ver').click(function() {

            var botao = $(this).val()
            if (botao == "turmas") {
                $('#turmas').toggle(2000);
            }



        });
    });
</script>
<style>
    fieldset {
        /* background-color: rgba(111, 66, 193, 0.3); */
        border-radius: 4px;
        border: 1px solid #ffc107;
        padding-bottom: 12px;
    }

    legend {
        background-color: #fff;
        border: 1px solid #ffc107;
        border-radius: 4px;
        color: var(--purple);
        font-size: 17px;
        font-weight: bold;
        padding: 3px 5px 3px 7px;
        width: auto;
    }
    input{
        text-transform: uppercase;
    }
</style>

@stop
