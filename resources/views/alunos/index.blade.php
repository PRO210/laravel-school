@extends('adminlte::page')

@section('title', 'alunos')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
</ol>

<h3>Alunos &nbsp;<a href="{{ route('alunos.create') }}" class="btn btn-outline-success ">ADD</a></h3>

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
        <form action="{{ route('alunos.search') }}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>NASCIMENTO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno)
                <tr>
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
                                <a class="dropdown-item" href="{{route('turmas.aluno.show',['uuid' => $aluno->uuid])}}" target='_self' title='Incluir na Turma'><span class='glyphicon glyphicon-pencil ' aria-hidden='true'>&nbsp;</span>Incluir na Turma</a>
                            </div>
                            &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class='checkbox' value='{{$aluno->uuid}}/'></span>
                            &nbsp;<span>{{ $aluno->NOME }}</span>
                        </div>
                    </td>
                    <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                    <td>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $alunos->appends($filters)->links() !!}
        @else
        {!! $alunos->links() !!}
        @endif
    </div>
</div>

@stop
