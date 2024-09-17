<!-- includes.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">

    <!-- Preloader CSS -->
    <link rel="stylesheet" href="static/css/preloader.min.css" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="static/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons CSS -->
    <link href="static/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App CSS -->
    <link href="static/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="static/css/metisMenu.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="static/css/custom.css" rel="stylesheet" type="text/css"> <!-- Archivo CSS personalizado -->
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
     <!-- Bootstrap Bundle JS -->
     <script src="static/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<!-- MetisMenu JS -->
<script src="static/js/metisMenu.min.js"></script>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    // Initialize Feather Icons
    feather.replace();
</script>

<!-- Pace JS (Preloader) -->
<script src="static/js/pace.min.js"></script>

<!-- Scripts específicos para el dashboard -->
<script>
$(document).ready(function () {
    // Variables para almacenar las instancias de los gráficos
    var chartBar = null, chartPie = null;

    // Función para destruir el gráfico si existe y limpiar el contenedor
    function destroyChart(chart, selector) {
        if (chart) {
            chart.destroy();
            chart = null;
        }
        $(selector).empty();  // Limpiar el contenedor
        console.log("Contenedor limpiado: " + selector);
    }

    // Cargar datos para las tarjetas informativas
    $.ajax({
        url: 'data_cards.php', // Archivo PHP que proporciona los datos en formato JSON
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Datos cargados para las tarjetas:", data); // Verificar datos
            $('#total-presupuesto').text('S/ ' + parseFloat(data.total_presupuesto).toLocaleString());
            $('#total-procesos').text(data.total_procesos);
            $('#procesos-requerimiento').text(data.procesos_requerimiento);
            $('#procesos-convocatoria').text(data.procesos_convocatoria);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar los datos de las tarjetas:', error);
            $('#total-presupuesto').text('Error al cargar los datos.');
            $('#total-procesos').text('Error al cargar los datos.');
            $('#procesos-requerimiento').text('Error al cargar los datos.');
            $('#procesos-convocatoria').text('Error al cargar los datos.');
        }
    });

    // Cargar datos para el gráfico de barras
    $.ajax({
        url: 'data_bar.php', // Archivo PHP que proporciona los datos en formato JSON
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Datos cargados para el gráfico de barras:", data); // Verificar datos
            // Destruir instancia anterior del gráfico de barras y limpiar el contenedor
            destroyChart(chartBar, "#chart-bar");

            var optionsBar = {
                series: [{
                    data: data.values
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    id: 'chart-bar-instance'
                },
                xaxis: {
                    categories: data.categories
                }
            };

            chartBar = new ApexCharts(document.querySelector("#chart-bar"), optionsBar);
            chartBar.render();
            console.log("Gráfico de barras creado.");
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar el gráfico de barras:', error);
        }
    });

    // Cargar datos para el gráfico circular
    $.ajax({
        url: 'data_pie.php', // Archivo PHP que proporciona los datos en formato JSON
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Datos cargados para el gráfico circular:", data); // Verificar datos
            // Destruir instancia anterior del gráfico circular y limpiar el contenedor
            destroyChart(chartPie, "#chart-pie");

            var optionsPie = {
                series: data.values,
                chart: {
                    type: 'pie',
                    height: 350,
                    id: 'chart-pie-instance'
                },
                labels: data.labels
            };

            chartPie = new ApexCharts(document.querySelector("#chart-pie"), optionsPie);
            chartPie.render();
            console.log("Gráfico circular creado.");
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar el gráfico circular:', error);
        }
    });
});

</script>
</body>
</html>