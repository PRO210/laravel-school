<script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'alunos')

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

<form action="{{ route('turmas.aluno.attach',$aluno->uuid) }}" method="POST" class="form">
    @csrf

    <h5>Aluno(a): {{$aluno->NOME}}</h5>

    <div class="card">
        {{-- <div class="card-header">Turmas Disponíveis</div> --}}
        <div class="card-body">
            <h5>Turmas Vinculadas</h5>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Turma</th>
                        <th>CATEGORIA/ANO</th>
                        <th>OUVINTE</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunoTurmas as $alunoTurma)
                    @foreach ($alunoTurma->turmas as $key => $turma)
                    <tr>
                        <td>
                            <span><input type='checkbox' name='turma_id[]' class='checkbox' value='{{$key}}/{{$turma->id}}'></span>
                            &nbsp; {{ $turma->TURMA }} - {{ $turma->UNICO }} &nbsp; ({{ $turma->TURNO }})
                        </td>
                        <td>{{ $turma->CATEGORIA }} / {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                        <td>
                            <select name="OUVINTE[]" id="" class=" form-control">
                                @if($turma->pivot->OUVINTE == "SIM")
                                <option selected value="SIM">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option value="NAO" selected>NÃO</option>
                                <option value="SIM">SIM</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <select name="classificacao_id[]" id="" class=" form-control">
                                @foreach($classificacoes as $classificacao)
                                @if($classificacao->id == $turma->pivot->classificacao_id)
                                <option value="{{$classificacao->id}}" selected>{{$classificacao->STATUS}}</option>
                                @else
                                <option value="{{$classificacao->id}}">{{$classificacao->STATUS}}</option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <button type="submit" name="salvar" value="salvar" class="btn btn-outline-success btn-block"><b>Adicionar / Salvar</b></button>
            </div>
            <div class="col-sm">
                <button type="submit" name="salvar" value="excluir" class="btn btn-outline-danger btn-block"><b>Excluir</b></button>
            </div>
        </div>
    </div>
    {{-- Turmas em que o aluno não está cadatrado --}}
    <div class="card" style="margin-top: 14px;">
        {{-- <div class="card-header">Turmas Disponíveis</div> --}}
        <div class="card-body">
            <h5>Turmas Disponíveis</h5>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Turma</th>
                        <th>CATEGORIA</th>
                        <th>ANO</th>
                        <th>OUVINTE</th>
                        <th>STATUS</th>
                    </tr>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmas as $key => $turma)
                    <tr>
                        <td>
                            <span><input type='checkbox' name='turma_id_02[]' class='checkbox' value='{{$key}}/{{$turma->id}}'></span>
                            &nbsp; {{ $turma->TURMA }} - {{ $turma->UNICO }} &nbsp; ({{ $turma->TURNO }})
                        </td>
                        <td>{{ $turma->CATEGORIA }}</td>
                        <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                        <td>
                            <select name="OUVINTE_02[]" id="" class=" form-control">
                                <option value="NAO" selected>NÃO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </td>
                        <td>
                            <select name="classificacao_id_02[]" id="" class=" form-control">
                                @foreach($classificacoes as $classificacao)
                                <option value="{{$classificacao->id}}">{{$classificacao->STATUS}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>


@stop
