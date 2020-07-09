@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'turmas/aluno/show')

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

    <div class="card" style="margin-top: 14px;">
        {{-- <div class="card-header">Turmas Disponíveis</div> --}}
        <div class="card-body">
            @foreach ($alunoTurmas as $alunoTurma)
            @foreach ($alunoTurma->turmas as $key => $turma)

            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>
                        <span>
                            <input class="turma" type='checkbox' name='turma_id[]' value='{{$key}}/{{$turma->id}}'>
                        </span>&nbsp;
                        {{ $turma->TURMA }} - {{ $turma->UNICO }} &nbsp; ({{ $turma->TURNO }}) &nbsp;<b>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</b>
                    </legend>
                    <div id="{{$key}}{{$turma->id}}" style="display: none;">
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Ouvinte:</label>
                            <div class="col-sm-4">
                                <select name="OUVINTE[]" id="" class=" form-control">
                                    @if($turma->pivot->OUVINTE == "SIM")
                                    <option selected value="SIM">SIM</option>
                                    <option value="NAO">NÃO</option>
                                    @else
                                    <option value="NAO" selected>NÃO</option>
                                    <option value="SIM">SIM</option>
                                    @endif
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Status:</label>
                            <div class="col-sm-4">
                                <select name="classificacao_id[]" id="" class=" form-control">
                                    @foreach($classificacoes as $classificacao)
                                    @if($classificacao->id == $turma->pivot->classificacao_id)
                                    <option value="{{$classificacao->id}}" selected>{{$classificacao->STATUS}}</option>
                                    @else
                                    <option value="{{$classificacao->id}}">{{$classificacao->STATUS}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Declaração:</label>
                            <div class="col-sm-4">
                                <select name="DECLARACAO[]" id="" class=" form-control">
                                    @if($turma->pivot->DECLARACAO == "SIM")
                                    <option value="SIM" selected>SIM</option>
                                    <option value="NAO">NÃO</option>
                                    @else
                                    <option value="SIM">SIM</option>
                                    <option value="NAO" selected>NÃO</option>
                                    @endif
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Data:</label>
                            <div class="col-sm-4">
                                <input type="date" name="DECLARACAO_DATA[]" value="{{$turma->pivot->DECLARACAO_DATA }}" id="" class=" form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Responsável:</label>
                            <div class="col-sm-10">
                                <input type="text" name="DECLARACAO_RESPONSAVEL[]" value="{{ $turma->pivot->DECLARACAO_RESPONSAVEL }}" class=" form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Transferência:</label>
                            <div class="col-sm-4">
                                <select name="TRANSFERENCIA[]" id="" class=" form-control">
                                    @if($turma->pivot->TRANSFERENCIA == "SIM")
                                    <option value="SIM" selected>SIM</option>
                                    <option value="NAO">NÃO</option>
                                    @else
                                    <option value="SIM">SIM</option>
                                    <option value="NAO" selected>NÃO</option>
                                    @endif
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Data:</label>
                            <div class="col-sm-4">
                                <input type="date" name="TRANSFERENCIA_DATA[]" value="{{$turma->pivot->TRANSFERENCIA_DATA }}" id="" class=" form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Responsável:</label>
                            <div class="col-sm-10">
                                <input type="text" name="TRANSFERENCIA_RESPONSAVEL[]" value="{{ $turma->pivot->TRANSFERENCIA_RESPONSAVEL }}" class=" form-control" placeholder="">
                            </div>
                        </div>
                </fieldset>
            </div>
            <br>
            @endforeach
            @endforeach
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <button type="submit" name="salvar" value="salvar" class="btn btn-outline-success btn-block" disabled onclick=" return confirmar() " title="Selecione ao menos uma turma">
                    <b>Adicionar / Salvar</b>
                </button>
            </div>
            <div class="col-sm">
                <button type="submit" name="salvar" value="excluir" class="btn btn-outline-danger btn-block" disabled title="Selecione ao menos uma turma">
                    <b>Excluir</b>
                </button>
            </div>
        </div>
    </div>
    {{-- Turmas em que o aluno não está cadatrado --}}
    <div class="card" style="margin-top: 14px;">
        {{-- <div class="card-header">Turmas Disponíveis</div> --}}
        <div class="card-body">
            @foreach ($turmas as $key => $turma)
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>
                        <span>
                            <input class="turma" type='checkbox' name='turma_id_02[]' value='{{$key}}/{{$turma->id}}'>
                        </span>&nbsp;
                        {{ $turma->TURMA }} - {{ $turma->UNICO }} &nbsp; ({{ $turma->TURNO }}) &nbsp;<b>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</b>
                    </legend>
                    <div id="{{$key}}{{$turma->id}}" style="display: none;">
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Ouvinte:</label>
                            <div class="col-sm-4">
                                <select name="OUVINTE_02[]" id="" class=" form-control">
                                    <option value="NAO" selected>NÃO</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Status:</label>
                            <div class="col-sm-4">
                                <select name="classificacao_id_02[]" id="" class=" form-control">
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
                                <select name="DECLARACAO_02[]" id="" class=" form-control">
                                    <option value="NAO" selected>NÃO</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Data:</label>
                            <div class="col-sm-4">
                                <input type="date" name="DECLARACAO_DATA_02[]" value="{{ $turma->DECLARACAO_DATA }}" id="" class=" form-control">
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Responsável:</label>
                            <div class="col-sm-10">
                                <input type="text" name="DECLARACAO_RESPONSAVEL_02[]" value="{{ $turma->DECLARACAO_RESPONSAVEL }}" class=" form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Transferência:</label>
                            <div class="col-sm-4">
                                <select name="TRANSFERENCIA_02[]" id="" class=" form-control">
                                    <option value="NAO" selected>NÃO</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Data:</label>
                            <div class="col-sm-4">
                                <input type="date" name="TRANSFERENCIA_DATA_02[]" value="{{ $turma->TRANSFERENCIA_DATA }}" id="" class=" form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="" class="col-sm-2 control-label">Responsável:</label>
                            <div class="col-sm-10">
                                <input type="text" name="TRANSFERENCIA_RESPONSAVEL_02[]" value="{{ $turma->TRANSFERENCIA_RESPONSAVEL }}" class=" form-control" placeholder="">
                            </div>
                        </div>
                </fieldset>
            </div><br>
            @endforeach
        </div>
    </div>
    <div style="margin-bottom: 60px;">
        <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.turma').click(function() {
            var turmas = $(this).val();
            var res = turmas.replace("/", '');
            var res = res.trim();
            $("#" + res + "").toggle(2000);
            // alert($('.turma').is(':checked'))
        });
    });
</script>
<style>
    fieldset {
        /* background-color: rgba(111, 66, 193, 0.3); */
        border-radius: 4px;
        border: 1px solid blue;
        padding-bottom: 12px;
    }

    legend {
        background-color: #fff;
        border: 1px solid blue;
        border-radius: 4px;
        color: var(--blue);
        font-size: 17px;
        font-weight: bold;
        padding: 3px 5px 3px 7px;
        width: auto;
    }
</style>
<script>
    //Valida os botões de salvar e excluir
    $('input[type=checkbox]').on('change', function() {
        var total = $('input[type=checkbox]:checked').length;
        if (total > 0) {
            //alert(total);
            $('.btn-block').removeAttr('disabled');
        } else {
            $('.btn-block').attr('disabled', 'disabled');
        }
    });
</script>
<script>
    //Confirmar se pode salvar
    function confirmar() {
        var u = $('#usuario').val();
        var r = confirm("Já Posso Enviar " + u + "? ");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script>
    //Deixa os checkbox mais bonitos
    $(document).ready(function() {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 3px; border-radius: 3px;padding-bottom: 2px;'>");
    });
</script>

@stop
