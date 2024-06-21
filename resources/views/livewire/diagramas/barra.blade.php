<div wire:ignore id="chart" style="width: 100%; height: auto;">
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            name: 'Masculino',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 89, 90]
        }, {
            name: 'Femenino',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 90, 100]
        }],
        chart: {
            type: 'bar',
            height: 350,
            widt|h: '100%', // Ajusta el ancho del gráfico al 100% del contenedor
            // Puedes ajustar otras opciones del gráfico según necesites
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: 'Cantidad de estudiantes'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return " " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
