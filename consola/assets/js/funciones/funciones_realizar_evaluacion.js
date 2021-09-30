var lista_id = [];
var posicion = 0;
var minutos_estimados = 0;
var segundos_estimados = 0;
var segundos_estimados = 0;
$(document).ready(function() {
    var id_resultado_evaluacion = $("#id_resultado_evaluacion").val();

    minutos_estimados = $("#minutos_estimados").val();
    segundos_estimados = $("#segundos_estimados").val();
    if (segundos_estimados == 0) {
        minutos_estimados--;
        segundos_estimados = 60;
    }
    if (id_resultado_evaluacion == "-1") {
        minutos_estimados--;
        segundos_estimados = 60;
    }
    traer_id_preguntas();
    init();
    traer_info_pregunta();
    guardar_resultado();
});

function guardar_resultado() {
    var id_evaluacion = $("#id_evaluacion").val();
    var id_resultado_evaluacion = $("#id_resultado_evaluacion").val();
    let tiempo = String(minutos_estimados) + "." + String(segundos_estimados);
    $.ajax({
        type: 'POST',
        url: "realizar_evaluacion.php",
        data: {
            process: 'guardar_evaluacion_automatico',
            id_evaluacion: id_evaluacion,
            id_resultado_evaluacion: id_resultado_evaluacion,
            tiempo_usado: tiempo
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            $("#id_resultado_evaluacion").val(datos.id_resultado_evaluacion);
        }
    });
}


function init() {
    setInterval(() => {
        segundos_estimados--;
        if (segundos_estimados % 10 == 0) {
            guardar_resultado();
        }
        document.getElementById('countdown').innerHTML = "Tiempo disponible : " + minutos_estimados + " minutos_estimados con " + segundos_estimados + " segundos_estimados";
        if (segundos_estimados == 0) {
            if (minutos_estimados == 0) {

            } else {
                minutos_estimados = minutos_estimados - 1;
                segundos_estimados = 59;
            }
        }
    }, 1000);
}


function traer_id_preguntas() {
    var id_evaluacion = $("#id_evaluacion").val();
    $.ajax({
        type: 'POST',
        url: "realizar_evaluacion.php",
        data: {
            process: 'traer_id_preguntas',
            id_evaluacion: id_evaluacion,
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            $.each(datos, function(key, value) {
                var arr = Object.keys(value).map(function(k) { return value[k] });
                var id_pregunta = arr[0];
                lista_id.push(id_pregunta);
            });

        }
    });
}


function traer_info_pregunta() {
    let id_pregunta = lista_id[posicion];
    let tamanio_array = lista_id.length;
    var id_evaluacion = $("#id_evaluacion").val();
    let id_resultado_evaluacion = $("#id_resultado_evaluacion").val();
    $.ajax({
        type: 'POST',
        url: "realizar_evaluacion.php",
        data: {
            process: 'traer_info_pregunta',
            id_pregunta: id_pregunta,
            posicion: posicion,
            tamanio_array: tamanio_array,
            id_evaluacion: id_evaluacion,
            id_resultado_evaluacion: id_resultado_evaluacion,
        },
        async: false,
        success: function(datos) {
            $("#contenido_pregunta").html("");
            $("#contenido_pregunta").html(datos);
            $(".btn_siguiente").click(function() {
                guardar_pregunta();
                posicion++;
                traer_info_pregunta();
            });
            $(".btn_anterior").click(function() {
                guardar_pregunta();
                posicion--;
                traer_info_pregunta();
            });
            $(".btn_terminar_prueba").click(function() {
                terminar_prueba();
            });
        }
    });
}

function guardar_pregunta() {
    let id_resultado_evaluacion = $("#id_resultado_evaluacion").val();
    let id_evaluacion = $("#id_evaluacion").val();
    let id_pregunta = lista_id[posicion];
    var arr = [];
    $("input:checkbox[name=check_lista]:checked").each(function() {
        arr.push($(this).val());
    });
    $.ajax({
        type: 'POST',
        url: "realizar_evaluacion.php",
        data: {
            process: 'guardar_pregunta',
            id_pregunta: id_pregunta,
            checkbox: arr,
            'id_resultado_evaluacion': id_resultado_evaluacion,
            'id_evaluacion': id_evaluacion
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            display_notify(datos.typeinfo, datos.msg);
        }
    });
}

function terminar_prueba() {
    swal({
            title: "Esta a punto de terminar la evaluacion, asegurese de haber respondido todo!",
            text: "Esta seguro de hacerlo?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, terminar",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                guardar_pregunta();
                finalizar_prueba();
            } else {
                swal("Cancelado", "Operación cancelada", "error");
                correcto++;
            }
        });
}

function finalizar_prueba() {
    var id_evaluacion = $("#id_evaluacion").val();
    var id_resultado_evaluacion = $("#id_resultado_evaluacion").val();
    let tiempo = String(minutos_estimados) + "." + String(segundos_estimados);
    $.ajax({
        type: 'POST',
        url: "realizar_evaluacion.php",
        data: {
            process: 'finalizar_prueba',
            id_evaluacion: id_evaluacion,
            id_resultado_evaluacion: id_resultado_evaluacion,
            tiempo_usado: tiempo
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            setInterval("reload1();", 1500);
        }
    });
}

function reload1() {
    location.href = 'dashboard.php';
}