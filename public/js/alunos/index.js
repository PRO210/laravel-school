    //Deixa os checkbox mais bonitos
    $(document).ready(function () {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
    });

    //Marcar ou Desmarcar todos os checkbox
    $(document).ready(function () {
        $('#selecionar').click(function () {
            if (this.checked) {
                $('.checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    });
    /* Datatable */
    $(document).ready(function () {

        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function () {
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
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
    //Deixa os checkbox mais bonitos
    $(document).ready(function () {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 3px; border-radius: 3px;padding-bottom: 2px;'>");
    });
