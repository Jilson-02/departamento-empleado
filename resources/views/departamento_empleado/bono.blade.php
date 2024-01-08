@extends('plantilla.app')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('contenido')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">:: Ingresar Empleados ::</h3>

            </div>
            {{-- <div class="form-group">
                <label>Nombre del Departamento</label>
                <input type="text" value="{{ $nombre_departamento }}" readonly>
            </div> --}}

            <form action="{{ url('bono', $empleado->id) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{$empleado->nombre}}"   name="nombre" class="form-control" placeholder="Nombre del empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{$empleado->apellido}}"  name="apellido" class="form-control" placeholder="Apellido del empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{$empleado->puesto}}"  name="puesto" class="form-control" placeholder="Puesto del empleado">
                    </div>
                    <div class="form-group">
                        <input type="number" value="{{$empleado->salario}}"  name="salario" class="form-control" placeholder="Salario del empleado">
                    </div>
                    <div class="form-group">
                        <input type="number" name="cantidadBono" class="form-control" placeholder="Cantidad de bono">
                    </div>
                </div>
                <form action="{{url('bonoatras', $empleado->id)}}" method="GET">
                    @csrf
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
                
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
