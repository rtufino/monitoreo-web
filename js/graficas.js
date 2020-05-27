Highcharts.chart('grafica-temperatura', {

    title: {
        text: 'Temperatura ambiental'
    },

    subtitle: {
        text: 'Temperatura en el Invernadero 1'
    },

    yAxis: {
        title: {
            text: 'Grados centígrados'
        }
    },

    xAxis: {
        title: {
            text: 'Fecha'
        }
        /*accessibility: {
            rangeDescription: 'Range: 2010 to 2017'
        }*/
    },
    /*
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    */
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2010
        }
    },

    series: [{
        name: 'Temperatura',
        data: [21.54, 22.67, 26.0, 12.6, 28.9]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});



Highcharts.chart('grafica-humedad', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Live Data Humedad'
    },
    data: {
        csvURL: 'http://localhost/ambiental/get-data.php',
        enablePolling: true,
        dataRefreshRate: parseInt(2, 20)
    }
});

