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

<form action="#" method="POST" class="form">
    @csrf
    <div class="card">
        {{-- <div class="card-header">Turmas Disponíveis</div> --}}
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th>ALUNO</th>
                        <th>TURMA</th>
                        <!-- <th>OUVINTE</th>
                        <th>STATUS</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunoTurmas as $alunoTurma)
                    <tr>
                    @foreach ($alunoTurma as $Key => $turma)


                        <td>
                            <span> <input type='checkbox' name='turma_id[]' class='checkbox' value='{{$turma}}'></span> &nbsp;
                        </td>






                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
