<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <table id="tableCategories" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Categoria</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function format ( data ) {
                return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
                    <thead>
                        <tr>
                            <th>Sub Categoria</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${getDataOfJSON(convertToJSON(data))}
                    </tbody>
                </table>
                `
            }

            function convertToJSON(array) {
                let json = JSON.parse(array)
                return json;
            }

            function getDataOfJSON(array) {
                let string = "";
                array.map(element => {
                    string+=`<tr>
                                <td id="idName">${element.name}</td>
                                <td class="active-status">Activo</td>
                                <td>Editar ${element.id}</td>
                                <td><button id="${element.id}" class="deleteSubCategory btn btn-danger">Eliminar ${element.id}</button></td>
                            </tr>`
                });
                return string
            }



            var table = $("#tableCategories").DataTable({
                proccessing: true,
                serverSide: true,
                pageLength: 5,
                ajax: `{{ route('categories.data') }}`,
                type: 'GET',
                language: {
                    emptyTable: "No hay información",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    lengthMenu:
                        "Mostrar <select>" +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="15">20</option>' +
                        '<option value="20">40</option>' +
                        "</select> registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                },
                columns: [
                    {
                        className: 'details-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data : "name"
                    },
                    {
                        data: "status"
                    }
                ],
                "order": [[1, 'asc']]
            })

            $('#tableCategories tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data().subCategory) ).show()
                    tr.addClass('shown');


                }
            } );

            $('#tableCategories tbody').on('click', 'button.deleteSubCategory', function () {
                let id = $(this).attr('id')

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        `Your file has been deleted. ID: ${id}`,
                        'success'
                        )
                    }
                })

            });




        </script>
    </body>
</html>
