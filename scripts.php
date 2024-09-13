<script>
$(document).ready(function() {
    $('#datatable-buttons').DataTable({
        dom: 'Bfrtip',  // Define la estructura de la tabla con botones
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Lista de Procesos',
                text: 'Excel'
            },
            {
                extend: 'pdfHtml5',
                title: 'Lista de Procesos',
                text: 'PDF'
            },
            {
                extend: 'print',
                title: 'Lista de Procesos',
                text: 'Imprimir'
            }
        ]
    });
});
</script>
