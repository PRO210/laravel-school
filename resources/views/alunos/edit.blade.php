@extends('adminlte::page')

@section('title', 'Cadastrar Novo Aluno(a)')

@section('content_header')
<h3>Editaro cadastro de: {{$aluno->NOME}}</h3>

@stop

@section('content')

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
        color: var(--purple);
        font-size: 17px;
        font-weight: bold;
        padding: 3px 5px 3px 7px;
        width: auto;
    }
</style>

<div class="card">
    <div class="card-body">

        @section('js')
        <!-- jQuery -->
        <script src='{{url("js/alunos/maskedInput.js")}}' type="text/javascript"></script>
        <script src='{{url("js/alunos/create.js")}}' type="text/javascript"></script>
        @stop

        <form action="{{route('aluno.update',$aluno->uuid)}}" method="post" class="">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Dados Pessoais:</legend>

                    <div class="row">
                        <label for="" class="col-sm-1 col-form-label">NOME:</label>
                        <div class="col-sm-6">
                            <input type="text" name="NOME" id="" value="{{$aluno->NOME}}" class="form-control" placeholder="Nome do Aluno(a)" required>
                        </div>
                        <label for="" class="col-sm-2 col-form-label">NASCIMENTO:</label>
                        <div class="col-sm-3">
                            <input type="date" name="NASCIMENTO" id="" value="{{$aluno->NASCIMENTO}}" class="form-control">
                        </div>
                    </div><br>
                    <div class="row">
                        <label for="" class="col-sm-2 col-form-label">CERTIDÃO CIVIL:</label>
                        <div class="col-sm-4">
                            <select name="CERTIDAO_CIVIL" id="" class="form-control">
                                @foreach($documentos as $documento)
                                @if($documento->NOME =="$aluno->CERTIDAO_CIVIL")
                                <option value="{{$documento->NOME}}" selected>{{$documento->NOME}}</option>
                                @else
                                <option value="{{$documento->NOME}}">{{$documento->NOME}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <label for="" class="col-sm-2 col-form-label">Matricula da Certidão:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="MATRICULA_CERTIDAO" value="{{$aluno->MATRICULA_CERTIDAO}}" placeholder="XXXXXXXXXX  XXXX  X  XXXXX  XXX  XXXXXXX  XX">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2  control-label">Modelo da Certidão:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MODELO_CERTIDAO" id="">
                                @if($aluno->MODELO_CERTIDAO =="NOVO")
                                <option value="NOVO" selected>NOVO</option>
                                <option value="VELHO">VELHO</option>
                                @else
                                <option value="VELHO" selected>VELHO</option>
                                <option value="NOVO">NOVO</option>
                                @endif
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Dados da Certidão:</label>
                        <div class="col-sm-4" id="">
                            <input type="text" class="form-control" id="" value="{{$aluno->DADOS_CERTIDAO}}" name="DADOS_CERTIDAO" placeholder="Termo N° XXX,  FLS: xxx,  Livro: xx.">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Expedição:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="" value="{{$aluno->EXPEDICAO_CERTIDAO}}" name="EXPEDICAO_CERTIDAO">
                        </div>
                        <label for="" class="col-sm-2 control-label">Cor/Raça:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->COR}}" name="COR" placeholder="Cor declarada pelo Aluno(a)">
                        </div>
                    </div>
                </fieldset>
            </div><br>
            <!-- Dados de Identificação -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Dados de Identificação:</legend>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nis:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$aluno->NIS}}" id="NIS" name="NIS" placeholder="">
                        </div>
                        <label for="" class="col-sm-2 control-label ">Bolsa Família:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="BOLSA_FAMILIA" id="">
                                @if($aluno->BOLSA_FAMILIA == "SIM")
                                <option selected value="SIM">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option value="NAO" selected>NÃO</option>
                                <option value="SIM">SIM</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="SUS" class="col-sm-2 control-label">SUS:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{$aluno->SUS}}" id="SUS" name="SUS">
                        </div>
                        <label for="CPF" class="col-sm-2 control-label">CPF:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{$aluno->CPF}}" id="CPF" name="CPF">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="RG" class="col-sm-1 control-label">RG:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="" value="{{$aluno->NUMERO_RG}}" name="NUMERO_RG" placeholder="Nº do RG">
                        </div>
                        <label for="" class="col-sm-2 control-label">Orgão Expedidor:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="" value="{{$aluno->ORGAO_EXPEDIDOR_RG}}" name="ORGAO_EXPEDIDOR_RG">
                        </div>
                        <label for="" class="col-sm-2 control-label">Expedição:</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="" value="{{$aluno->EXPEDICAO_RG}}" name="EXPEDICAO_RG">
                        </div>
                    </div>
                </fieldset>
            </div><br>
            <!-- Parentesco  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Parentesco:</legend>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label ">Naturalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->NATURALIDADE}}" name="NATURALIDADE">
                        </div>
                        <label for="" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->ESTADO}}" name="ESTADO">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nacionalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->NACIONALIDADE}}" name="NACIONALIDADE">
                        </div>
                        <label for="inputSexo" class="col-sm-2  control-label">Sexo</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="SEXO" id="" required>
                                @if($aluno->SEXO == "MASCULINO")
                                <option value="MASCULINO" selected>MASCULINO</option>
                                <option value="FEMININO">FEMININO</option>
                                <option value="---------">Marque uma Opção</option>
                                @elseif($aluno->SEXO == "FEMININO")
                                <option value="FEMININO" selected>FEMININO</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="---------">Marque uma Opção</option>
                                @else
                                <option value="---------" selected>Marque uma Opção</option>
                                <option value="FEMININO">FEMININO</option>
                                <option value="MASCULINO">MASCULINO</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nome do Pai</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->PAI}}" name="PAI">
                        </div>
                        <label for="" class="col-sm-2 control-label">Profissão do Pai</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->PROF_PAI}}" name="PROF_PAI">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nome da Mãe</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->MAE}}" name="MAE">
                        </div>
                        <label for="" class="col-sm-2 control-label">Profissão da Mãe</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->PROF_MAE}}" name="PROF_MAE">
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Localização  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Localização:</legend>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Endereço:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="ENDERECO" value="{{$aluno->ENDERECO}}" placeholder="Nome da Rua/Sítio ou Afins">
                        </div>
                        <label for="" class="col-sm-2 control-label">Fones:</label>
                        <div class="col-sm-2">
                            <input id="FONE" type="text" class="form-control" name="FONE" value="{{$aluno->FONE}}" placeholder="XX-XXXXX-XXXX">
                        </div>
                        <div class="col-sm-2">
                            <input id="FONE_II" type="text" class="form-control" name="FONE_II" value="{{$aluno->FONE_II}}" placeholder="XX-XXXXX-XXXX">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Cidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->CIDADE}}" name="CIDADE">
                        </div>
                        <label for="" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" value="{{$aluno->CIDADE_ESTADO}}" name="CIDADE_ESTADO">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Transporte</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="TRANSPORTE" id="inputTransporte">
                                @if($aluno->TRANSPORTE == "SIM")
                                <option selected value="SIM">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option>SIM</option>
                                <option value="NAO" selected>NÃO</option>
                                @endif
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Urbano/Rural</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="URBANO" id="">
                                @if($aluno->URBANO == "SIM")
                                <option checked value="SIM">Urbano</option>
                                <option value="NAO">Rural</option>
                                @else
                                <option value="SIM">Urbano</option>
                                <option value="NAO" selected>Rural</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="motoristas">
                        <label for="" class="col-sm-2  control-label">Motorista</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MOTORISTA" id="inputMotorista">

                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Motorista II</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MOTORISTA_II" id="inputMotorista2">

                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Sáude  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Sáude:</legend>
                    <div class="row">
                        <label for="inputNecessidades" class="col-sm-2 control-label">Necessidasdes Especiais:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="" name="NECESSIDADES_ESPECIAIS">
                                @if($aluno->NECESSIDADES_ESPECIAIS == "SIM")
                                <option value="NAO">NÃO</option>
                                <option value="SIM" selected>SIM</option>
                                @else
                                <option value="NAO" selected>NÃO</option>
                                <option value="SIM">SIM</option>
                                @endif
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Cod. da Necessidade:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{$aluno->NECESSIDADES_ESPECIAIS_CODIGO}}" name="NECESSIDADES_ESPECIAIS_CODIGO" placeholder="Código da Doença">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-3 control-label">Descrição da Necessidade:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="2" id="" value="{{$aluno->NECESSIDADES_ESPECIAIS_DESCRICACAO}}" name="NECESSIDADES_ESPECIAIS_DESCRICACAO" placeholder="Livre para Registro de quaisquer observações">{{$aluno->NECESSIDADES_ESPECIAIS_DESCRICACAO}}</textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Observações  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Observações:</legend>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="4" id="" name="OBSERVACOES" placeholder="Livre para Registro de quaisquer observações a respeito do aluno(a)">{{$aluno->OBSERVACOES}}</textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-success btn-block " onclick="return confirmar()"><B>Salvar</B></button>
                    </div>
                </div>
            </div>
            <div style="margin-bottom: 60px;">
                <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
            </div>
        </form>
    </div>
</div>

@stop
