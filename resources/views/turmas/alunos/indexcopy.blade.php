

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
@include('turmas.alunos.datatables')

    <div class="container-fluid">
        <script>
            //Deixa os checkbox mais bonitos
            $(document).ready(function() {
                $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
            });
        </script>

        <style>
            .paddingButton {
                border-color: aliceblue;
                padding: 0px;
            }

            .table td,
            .table th {
                padding: 10px;
            }
        </style>

        <form action="#" method="POST" class="form">
            @csrf

            <div class="row">
                <div class="col-12">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>

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
                    </table>
                </div>
            </div>
</body>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({

            "lengthMenu": [
                [5, 10, 15, 20, 100, -1],
                [5, 10, 15, 20, "All"]
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
            "responsive": true,

        });

    });
</script>

</html>
