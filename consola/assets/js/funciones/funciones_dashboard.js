$(function() {
    $(document).on("click", "#btnCanjearOferta", function(event) {
        let codigo_cupon = $("#codigo_cupon_canje").val();
        canje_cupon(codigo_cupon);
    });
    $(document).on("click", "#btnLimpiarOferta", function(event) {
        $("#contenedor_caja2").html("");
        $("#codigo_canje").val("");
    });
});

$(document).ready(function() {
    grafica1();
    grafica2();
    grafica3();
    grafica4();
});

function grafica1() {
    let base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "/dashboard/grafica1",
        method: "POST",
        success: function(data) {
            var producto = [];
            var total = [];
            var obj = jQuery.parseJSON(data);
            var sales = [];
            for (var i in obj) {
                producto.push(obj[i].producto);
                total.push(obj[i].total);
                var json = { "name": (obj[i].producto), "data": [parseFloat(obj[i].total)] }
                sales.push(json);
            }
            Highcharts.chart('container1', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'COMPRAS REALIZADAS POR MES'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'TOTAL DE COMPRAS'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} ($)</b> DE TOTAL<br/>'
                },
                series: sales,
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function grafica2() {
    let base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "/dashboard/grafica2",
        method: "POST",
        success: function(data) {
            var producto = [];
            var total = [];
            var obj = jQuery.parseJSON(data);
            var sales = [];
            for (var i in obj) {
                producto.push(obj[i].producto);
                total.push(obj[i].total);
                var json = { "name": (obj[i].producto), "data": [parseFloat(obj[i].total)] }
                sales.push(json);
            }
            Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'UTILIDADES GENERADAS POR MES'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: producto,
                },
                yAxis: {
                    title: {
                        text: 'UTILIDADES'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}($)</b> DE TOTAL<br/>'
                },
                series: sales,
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}


function grafica3() {
    let base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "/dashboard/grafica3",
        method: "POST",
        success: function(data) {
            var producto = [];
            var total = [];
            var obj = jQuery.parseJSON(data);
            var sales = [];
            for (var i in obj) {
                producto.push(obj[i].producto);
                total.push(obj[i].total);
                var json = { "name": (obj[i].producto), "data": [parseFloat(obj[i].total)] }
                sales.push(json);
            }
            Highcharts.chart('container3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'INGRESOS POR MES'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'TOTAL DE INGRESOS'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} ($)</b> DE TOTAL<br/>'
                },
                series: sales,
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function grafica4() {
    let base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "/dashboard/grafica4",
        method: "POST",
        success: function(data) {
            var producto = [];
            var total = [];
            var obj = jQuery.parseJSON(data);
            var sales = [];
            for (var i in obj) {
                producto.push(obj[i].producto);
                total.push(obj[i].total);
                var json = { "name": (obj[i].producto), "data": [parseFloat(obj[i].total)] }
                sales.push(json);
            }
            Highcharts.chart('container4', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'INGRESOS MENOS COMISION GENERADOS POR MES'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: producto,
                },
                yAxis: {
                    title: {
                        text: 'TOTAL DE INGRESOS MENOS COMISION'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}($)</b> DE TOTAL<br/>'
                },
                series: sales,
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}




function ir_al_curso(id_curso) {
    window.location = 'ver_curso.php?id_curso=' + id_curso;
}
$(".btn_empezar_prueba").click(function() {
    let id_evaluacion = $(this).attr('id');
    window.location = 'realizar_evaluacion.php?id_evaluacion=' + id_evaluacion;
});

$(".btn_revisar_resultados").click(function() {
    let id_evaluacion = $(this).attr('id');
    window.location = 'resultado_individual.php?id_evaluacion=' + id_evaluacion;
});

$("#btn_verificar_codigo").click(function() {
    let codigo = $("#codigo_canje").val();
    let base_url = $("#base_url").val();
    var dataString = 'codigo=' + codigo;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/canjear_oferta",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                $("#contenedor_caja2").html(datax.contenido);
            }
        }
    });
});

function canje_cupon(codigo_cupon) {
    let base_url = $("#base_url").val();
    var dataString = 'codigo=' + codigo_cupon;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/canje_cupon",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                $("#contenedor_caja2").html("");
                $("#codigo_canje").val("");
            }
        }
    });
}

function reload1() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/dashboard';
}