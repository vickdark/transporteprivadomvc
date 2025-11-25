<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Vehículos</h3>
        <button class="btn btn-primary" id="btnNuevo">Nuevo vehículo</button>
    </div>
    <div class="card-body">
        <table id="tablaVehiculos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalVehiculo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Nuevo vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVehiculo">
                    <input type="hidden" id="vehiculoId">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Placa</label>
                            <input type="text" class="form-control" id="placa" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Marca</label>
                            <input type="text" class="form-control" id="marca" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Modelo</label>
                            <input type="text" class="form-control" id="modelo" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Año</label>
                            <input type="number" class="form-control" id="anio" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Color</label>
                            <input type="text" class="form-control" id="color" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Capacidad</label>
                            <input type="number" class="form-control" id="capacidad" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" id="estado" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= asset('assets/resourses/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">

<script>
    window.addEventListener('load', function () {
        const baseUrl = '<?= BASE_URL ?>';
        const rutaList = baseUrl + '/vehiculos/list';
        const rutaCreate = baseUrl + '/vehiculos/create';
        const rutaShow = (id) => baseUrl + '/vehiculos/show/' + id;
        const rutaUpdate = (id) => baseUrl + '/vehiculos/update/' + id;
        const rutaDelete = (id) => baseUrl + '/vehiculos/delete/' + id;

        const $ = window.jQuery;
        let tabla = $('#tablaVehiculos').DataTable({
            ajax: { url: rutaList, dataSrc: '' },
            columns: [
                { data: 'id' },
                { data: 'placa' },
                { data: 'marca' },
                { data: 'modelo' },
                { data: 'anio' },
                { data: 'color' },
                { data: 'capacidad' },
                { data: 'estado' },
                {
                    data: null,
                    render: function (row) {
                        return '<button class="btn btn-sm btn-info btn-editar" data-id="'+row.id+'">Editar</button> ' +
                               '<button class="btn btn-sm btn-danger btn-eliminar" data-id="'+row.id+'">Eliminar</button>';
                    },
                    orderable: false
                }
            ]
        });

        $('#btnNuevo').on('click', function () {
            $('#modalTitulo').text('Nuevo vehículo');
            $('#vehiculoId').val('');
            $('#formVehiculo')[0].reset();
            $('#modalVehiculo').modal('show');
        });

        $('#tablaVehiculos').on('click', '.btn-editar', function () {
            const id = $(this).data('id');
            $.get(rutaShow(id), function (data) {
                $('#modalTitulo').text('Editar vehículo');
                $('#vehiculoId').val(data.id);
                $('#placa').val(data.placa);
                $('#marca').val(data.marca);
                $('#modelo').val(data.modelo);
                $('#anio').val(data.anio);
                $('#color').val(data.color);
                $('#capacidad').val(data.capacidad);
                $('#estado').val(data.estado);
                $('#modalVehiculo').modal('show');
            });
        });

        $('#tablaVehiculos').on('click', '.btn-eliminar', function () {
            const id = $(this).data('id');
            if (!confirm('¿Eliminar vehículo?')) return;
            $.post(rutaDelete(id), function () { tabla.ajax.reload(); });
        });

        $('#btnGuardar').on('click', function () {
            const payload = {
                placa: $('#placa').val(),
                marca: $('#marca').val(),
                modelo: $('#modelo').val(),
                anio: $('#anio').val(),
                color: $('#color').val(),
                capacidad: $('#capacidad').val(),
                estado: $('#estado').val()
            };
            const id = $('#vehiculoId').val();
            const after = function () { $('#modalVehiculo').modal('hide'); tabla.ajax.reload(); };
            if (id) { $.post(rutaUpdate(id), payload, after); } else { $.post(rutaCreate, payload, after); }
        });
    });
</script>
