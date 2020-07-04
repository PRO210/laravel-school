<!-- <script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script> -->

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
<script src='{{url("js/https _adminlte.io_themes_v3_plugins_jquery_jquery.min.js")}}' type="text/javascript"></script>

<!-- DataTables -->
<script src='{{url("https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js")}}'></script>
<script src='{{url("https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{url("https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js")}}'></script>
<script src='{{url("https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js")}}'></script>

<script>
    $(document).ready(function() {

        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
        var table = $('#example').DataTable({

            "columnDefs": [{
                "targets": 0,
                "orderable": false
            }],
            "lengthMenu": [
                [5, 10, 15, 20, 100, -1],
                [5, 10, 15, 20, 100, "All"]
            ],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhum aluno encontrado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de alunos)",
                "paginate": {
                    "first": "Primeira",
                    "last": "Ultima",
                    "next": "Proxima",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": ative a ordenação cressente",
                    "sortDescending": ": ative a ordenação decressente"
                }
            },

        });
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
</script>
<script>
    //Deixa os checkbox mais bonitos
    $(document).ready(function() {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
    });
</script>
<script>
    //Marcar ou Desmarcar todos os checkbox
    $(document).ready(function() {
        $('#selecionar').click(function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>

@stop

@section('css')
<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css')}}">
@stop

<style>
    .paddingButton {
        border-color: aliceblue;
        padding: 0px;
    }

    .table td,
    .table th {
        padding: 10px;
    }

    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .checkbox {
        display: inline-block !important;
    }
</style>

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
                                                <a class="dropdown-item" href="{{route('turmas.aluno.show',['uuid' => $aluno->uuid])}}" target='_self' title='Incluir na Turma'><span class='glyphicon glyphicon-pencil ' aria-hidden='true'>&nbsp;</span>Incluir na Turma</a>
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
                                    <th></th>
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
