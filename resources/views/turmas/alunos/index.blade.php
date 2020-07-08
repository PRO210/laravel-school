@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'turmas/alunos')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('turmas.index') }}" class="active">Turmas</a></li>
    </ol>
</nav>
@stop

@section('content')

@section('js')
<!-- jQuery -->
<script src='{{url("js/jquery-3.5.1.js")}}' type="text/javascript"></script>
<!-- DataTables -->
<script src='{{url("js/dataTables/jquery.dataTables.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.responsive.min.js")}}'></script>
<script src='{{url("js/dataTables/responsive.bootstrap4.min.js")}}'></script>
<script src='{{url("js/alunos/index.js")}}'></script>
@stop

@section('css')
<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('css/datatables/alunos/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('css/datatables/alunos/dataTables/bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('css/datatables/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
@stop

<form action="#" method="POST" class="form" name="form">

    @csrf

    <!-- @section('plugins.Datatables', true) -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">Turmas Disponíveis</div> --}}

                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <span><input type='checkbox' name='' for='' class='' value='' id="selecionar"></span>
                                    </th>
                                    <th>ALUNO</th>
                                    <th>TURMA</th>
                                    <!-- <th>OUVINTE</th> -->
                                    <th>STATUS</th>
                                    <th>MÃE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alunoTurmas as $aluno)
                                @foreach ($aluno->turmas as $Key => $turma)
                                @endforeach
                                <tr>
                                    <th></th>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success paddingButton" data-toggle="dropdown">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('alunos.edit',['uuid' => $aluno->uuid])}}" target='_self' title='Alterar o Cadastro'>
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Alterar o Cadastro</b></a>
                                                <a class="dropdown-item" href="{{route('turmas.aluno.show',['uuid' => $aluno->uuid])}}" target='_self' title='Incluir na Turma'>
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z" />
                                                        <path fill-rule="evenodd" d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Gerenciar Turmas
                                                </a>

                                            </div>
                                            &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' for='NOME' class='checkbox' value='{{$aluno->uuid}}/{{$turma->id}}'></span>
                                            &nbsp;<span id="NOME">{{ $aluno->NOME }}</span>
                                        </div>
                                    </td>
                                    <td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                                    <td>
                                        @foreach($classificacoes as $classificacao)
                                        @if($turma->pivot->classificacao_id == "$classificacao->id")
                                        {{$classificacao->STATUS}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{$aluno->MAE}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="thTfoot"></th>
                                    <th>ALUNO</th>
                                    <th>TURMA</th>
                                    <!-- <th>OUVINTE</th> -->
                                    <th>STATUS</th>
                                    <th>MÃE</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <button type="submit" name="salvar" value="salvar" class="btn btn-outline-success btn-block"><b>Adicionar / Salvar</b></button>
            </div>
            <div class="col-sm">
                <button type="submit" name="salvar" value="excluir" class="btn btn-outline-danger btn-block"><b>Excluir</b></button>
            </div>
        </div>
    </div> -->

</form>

@stop
