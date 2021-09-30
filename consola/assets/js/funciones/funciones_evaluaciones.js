var urlprocess = 'agregar_evaluacion.php';
$(document).ready(function() {
    /* LLAMA LA FUNCION GENERAR 2 LA CUAL SIRVE PARA TRAER LOS DATOS DE LAS EVALUACIONES
    AL DATATABLE CON LA LIBRERIA SSP.CUSTOMIZED.CLASS.PHP */
    comprobar_preguntas();
    generar2();

    /* ESCONDEMOS LOS ULTIMOS 3 PROGRESS BAR Y LOS ULTIMOS 3 DIV QUE CONTIENE EL ARCHIVO */
    $("#parte_2").hide();
    $("#parte_3").hide();
    $("#parte_4").hide();

    $("#segundo_div").hide();
    $("#tercer_div").hide();
    $("#cuarto_div").hide();

    /* PONEMOS EN TIMEPICKI LOS CAMPOS DE HORA */
    $("#hora_inicio").timepicki();
    $("#hora_fin").timepicki();

    /* AGREGAR SELECT2 */
    $(".select").select2();

    /*ESTA FUNCION SIRVE PARA AGREGAR UNA NUEVA PREGUNTA */
    $(document).on("click", "#btn_add_pregunta", function() {
        agregar_pregunta();
    });

    $(document).on("click", "#btn_cerrar_fc", function() {
        actualizar_tabla_general();
    });
    /*ESTA FUNCION VA A SERVIR PARA PODER EDITAR LAS RESPUESTAS */
    $(document).on("click", "#respuestas_pre .comentario", function(e) {
        campos($(this), "", 0, 0);
    });
    $(document).on("click", "#porcentaje_respuestas .comentario", function(e) {
        campos($(this), "", 0, 0);
    });
    actualizar_tabla_general();
});

/* ESTOS BOTONES SIRVEN PARA GUARDAR LA PRIMERA PARTE DE LA EVALUACION */
$("#btn_guardar_siguiente").click(function() {
    guardar_datos_primera_parte(1)
});
$("#btn_guardar").click(function() {
    guardar_datos_primera_parte(0)
});

$("#btn_guardar_siguiente2").click(function() {
    guardar_porcentajes(1)
});
$("#btn_guardar2").click(function() {
    guardar_porcentajes(0)
});

$("#btn_guardar_publicar").click(function() {
    guardar_evaluacion(1)
});
$("#btn_guardar3").click(function() {
    guardar_evaluacion(0)
});


$("#btn_siguiente_1").click(function() {
    $("#parte_1").hide();
    $("#parte_2").show();
    $("#segundo_div").show();
    $("#primer_div").hide();
});



$("#btn_anterior1").click(function() {
    $("#parte_1").show();
    $("#parte_2").hide();
    $("#segundo_div").hide();
    $("#primer_div").show();
});

$("#btn_anterior2").click(function() {
    $("#parte_2").show();
    $("#parte_3").hide();
    $("#tercer_div").hide();
    $("#segundo_div").show();
});
$("#btn_anterior3").click(function() {
    $("#parte_3").show();
    $("#parte_4").hide();
    $("#cuarto_div").hide();
    $("#tercer_div").show();
});
/* ESTA FUNCION SIRVE PARA MANDAR A GUARDAR LOS DATOS DE LA PRIMERA PARTE
DE LA CREACION DE LA EVALUACION EN DONDE RECIBE UN PARAMETRO LLAMADO tipo
EL CUAL VERIFICARA SI GUARDARA Y PASARA A LA SIGUIENTE PARTE O SOLO GUARDARA*/
function guardar_datos_primera_parte(tipo) {
    let nombre = $("#nombre").val();
    let tiempo_estimado = $("#tiempo_estimado").val();
    let nota_minima = $("#nota_minima").val();
    let nota_maxima = $("#nota_maxima").val();
    let fecha_inicio = $("#fecha_inicio").val();
    let hora_inicio = $("#hora_inicio").val();
    let fecha_fin = $("#fecha_fin").val();
    let hora_fin = $("#hora_fin").val();
    let curso = $("#curso").val();
    let descripcion_evaluacion = $("#descripcion_evaluacion").val();
    let fecha_actual = $("#fecha_actual").val();
    let hora_actual = $("#hora_actual").val();
    let id_evaluacion = $("#id_evaluacion").val();
    let dataString = "process=insertar_evaluacion";
    dataString += "&nombre=" + nombre;
    dataString += "&tiempo_estimado=" + tiempo_estimado;
    dataString += "&nota_minima=" + nota_minima;
    dataString += "&nota_maxima=" + nota_maxima;
    dataString += "&fecha_inicio=" + fecha_inicio;
    dataString += "&hora_inicio=" + hora_inicio;
    dataString += "&fecha_fin=" + fecha_fin;
    dataString += "&hora_fin=" + hora_fin;
    dataString += "&curso=" + curso;
    dataString += "&descripcion_evaluacion=" + descripcion_evaluacion;
    dataString += "&fecha_actual=" + fecha_actual;
    dataString += "&hora_actual=" + hora_actual;
    dataString += "&id_evaluacion=" + id_evaluacion;
    if (nombre != "") {
        if (tiempo_estimado >= 1 && tiempo_estimado != "") {
            if (nota_minima != "" && nota_minima >= 0) {
                if (nota_maxima != "" && parseFloat(nota_maxima) >= 0 && parseFloat(nota_maxima) >= parseFloat(nota_minima)) {
                    if (fecha_inicio != "" && fecha_inicio >= fecha_actual) {
                        if (fecha_inicio > fecha_actual) {
                            if (hora_inicio != "") {
                                if (fecha_fin != "" && fecha_fin >= fecha_inicio) {
                                    if (fecha_fin > fecha_inicio) {
                                        if (hora_fin != "") {
                                            if (curso != "") {
                                                if (descripcion_evaluacion != "") {
                                                    guardar_primera_parte(dataString, tipo);
                                                } else {
                                                    display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                            }
                                        } else {
                                            display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                        }
                                    }
                                    if (fecha_fin == fecha_inicio) {
                                        if (hora_fin != "" && convertir_hora(hora_fin) > convertir_hora(hora_inicio)) {
                                            if (curso != "") {
                                                if (descripcion_evaluacion != "") {
                                                    guardar_primera_parte(dataString, tipo);
                                                } else {
                                                    display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                            }
                                        } else {
                                            display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                        }
                                    }
                                } else {
                                    display_notify("Error", "La fecha de finalizacion no puede ir vacia o ser menor a la fecha de inicio!!");
                                }
                            } else {
                                alert("HOLA");
                                display_notify("Error", "La hora de inicio no puede ir vacia o ser menor a la hora actual!!");
                            }
                        }
                        if (fecha_inicio == fecha_actual) {
                            if (id_evaluacion == "-1") {
                                if (hora_inicio != "" && convertir_hora(hora_inicio) >= convertir_hora(hora_actual)) {
                                    if (fecha_fin != "" && fecha_fin >= fecha_inicio) {
                                        if (fecha_fin > fecha_inicio) {
                                            if (hora_fin != "") {
                                                if (curso != "") {
                                                    if (descripcion_evaluacion != "") {
                                                        guardar_primera_parte(dataString, tipo);
                                                    } else {
                                                        display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                    }
                                                } else {
                                                    display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                            }
                                        }
                                        if (fecha_fin == fecha_inicio) {
                                            if (hora_fin != "" && convertir_hora(hora_fin) > convertir_hora(hora_inicio)) {
                                                if (curso != "") {
                                                    if (descripcion_evaluacion != "") {
                                                        guardar_primera_parte(dataString, tipo);
                                                    } else {
                                                        display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                    }
                                                } else {
                                                    display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                            }
                                        }
                                    } else {
                                        display_notify("Error", "La fecha de finalizacion no puede ir vacia o ser menor a la fecha de inicio!!");
                                    }
                                } else {
                                    display_notify("Error", "La hora de inicio no puede ir vacia o ser menor a la hora actual!!");
                                }
                            } else {
                                if (fecha_fin != "" && fecha_fin >= fecha_inicio) {
                                    if (fecha_fin > fecha_inicio) {
                                        if (hora_fin != "") {
                                            if (curso != "") {
                                                if (descripcion_evaluacion != "") {
                                                    guardar_primera_parte(dataString, tipo);
                                                } else {
                                                    display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                            }
                                        } else {
                                            display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                        }
                                    }
                                    if (fecha_fin == fecha_inicio) {
                                        if (hora_fin != "" && convertir_hora(hora_fin) > convertir_hora(hora_inicio)) {
                                            if (curso != "") {
                                                if (descripcion_evaluacion != "") {
                                                    guardar_primera_parte(dataString, tipo);
                                                } else {
                                                    display_notify("Error", "Se tiene que agregar una descripcion a la evaluacion!!");
                                                }
                                            } else {
                                                display_notify("Error", "Se tiene que seleccionar un curso para la evaluacion!!");
                                            }
                                        } else {
                                            display_notify("Error", "La hora de finalizacion no puede ir vacia o ser menor o igual a la hora de inicio");
                                        }
                                    }
                                } else {
                                    display_notify("Error", "La fecha de finalizacion no puede ir vacia o ser menor a la fecha de inicio!!");
                                }
                            }
                        }
                    } else {
                        display_notify("Error", "La fecha de inicio no puede ir vacia o ser menor a la fecha actual!!");
                    }
                } else {
                    display_notify("Error", "La nota maxima no puede ser menor a 0, ni tampoco puede ir vacia, ni ser menor a la nota minima!!");
                }
            } else {
                display_notify("Error", "La nota minima no puede ser menor a 0, ni tampoco puede ir vacia!!");
            }
        } else {
            display_notify("Error", "El tiempo estimado no puede ser de 0 o menor a 0, ni tampoco puede ir vacio!!");
        }
    } else {
        display_notify("Error", "El campo 'Nombre de la evaluacion' no puede ir vacio!!");
    }
}

/* ESTA FUNCION SERVIRA PARA MANDAR A GUARDAR LOS DATOS A LA BASE DE DATOS CON RESPECTO
A LA EVALUACION QUE SE HARA */
function guardar_primera_parte(dataString, tipo) {
    $.ajax({
        type: 'POST',
        url: urlprocess,
        data: dataString,
        dataType: 'json',
        async: false,
        success: function(datax) {
            process = datax.process;
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                $("#id_evaluacion").val(datax.id_evaluacion);
            }
        }
    });
    if (tipo == 1) {
        $("#parte_1").hide();
        $("#parte_2").show();
        $("#segundo_div").show();
        $("#primer_div").hide();
    }
}


/*LA FUNCIONG generar2() SIRVE PARA PODER TRAER LOS DATOS DESDE admin_evaluaciones_dt.php
HASTA EL DATATABLE con SERVERSIDE*/
function generar2() {
    let id_curso = $("#id_curso").val();
    dataTable = $('#editable2').DataTable().destroy()
    dataTable = $('#editable2').DataTable({
        "pageLength": 50,
        "order": [0, 'desc'],
        "processing": true,
        "autoWidth": false,
        "serverSide": true,
        "ajax": {
            url: "admin_evaluaciones_dt.php?id_curso=" + id_curso, // json datasource
            //url :"admin_factura_rangos_dt.php", // json datasource
            //type: "post",  // method  , by default get
            error: function() { // error handling
                $(".editable2-error").html("");
                $("#editable2").append('<tbody class="editable_grid-error"><tr><th colspan="3">No se encontró información segun busqueda </th></tr></tbody>');
                $("#editable2_processing").css("display", "none");
                $(".editable2-error").remove();
            }
        }
    });

    dataTable.ajax.reload()
        //}
}

/* ESTA FUNCION SERVIRA PARA CONVERTIR LAS FECHAS DE AM-PM A UNA NOTACION H:M:S */
function convertir_hora(time) {
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
    if (AMPM == "PM" && hours < 12) hours = hours + 12;
    if (AMPM == "AM" && hours == 12) hours = hours - 12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if (hours < 10) sHours = "0" + sHours;
    if (minutes < 10) sMinutes = "0" + sMinutes;
    return (sHours + ":" + sMinutes);
}

/* ESTA FUNCION LIMPIA EL MODAL CADA VEZ QUE ESTE SE CIERRA */
$(document).on('hidden.bs.modal', function(e) {
    var target = $(e.target);
    target.removeData('bs.modal').find(".modal-content").html('');
});

/* ESTA FUNCION SIRVE PARA AGREGAR UNA NUEVA PREGUNTA */
function agregar_pregunta() {
    let descripcion_pregunta = $("#descripcion_pregunta").val();
    let id_pregunta = $("#id_pregunta").val();
    let id_evaluacion = $("#id_evaluacion").val();
    var dataString = "process=insertar_pregunta";
    dataString += "&descripcion_pregunta=" + descripcion_pregunta;
    dataString += "&id_pregunta=" + id_pregunta;
    dataString += "&id_evaluacion=" + id_evaluacion;
    $.ajax({
        type: 'POST',
        url: "agregar_pregunta_respuesta.php",
        data: dataString,
        dataType: 'json',
        async: false,
        success: function(datax) {
            let id_pregunta_devuelta = datax.id_pregunta;
            $("#id_pregunta").val(id_pregunta_devuelta);
            if (datax.typeinfo == "Success") {
                if (id_pregunta == "-1") {
                    let id_respuesta1 = datax.id_respuesta1;
                    let id_respuesta2 = datax.id_respuesta2;
                    let select1 = "<select class=\" select\" id=\"tipo\" name=\"tipo\">";
                    select1 += "<option value = '1' selected >Correcto</option>";
                    select1 += "<option value = '0' >Incorrecto</option>";
                    select1 += "</select>";
                    let select2 = "<select class=\" select\" id=\"tipo\" name=\"tipo\">";
                    select2 += "<option value = '1' >Correcto</option>";
                    select2 += "<option value = '0' selected>Incorrecto</option>";
                    select2 += "</select>";
                    let eliminar1 = "<a class='btn eliminar_respuesta' id='" + id_respuesta1 + "'><i class='fa fa-trash'></i></a>";
                    let eliminar2 = "<a class='btn eliminar_respuesta' id='" + id_respuesta2 + "'><i class='fa fa-trash'></i></a>";
                    $("#tabla_pre_res").show();
                    let fila = "<tr class='respu' id='" + id_respuesta1 + "'>";
                    fila += "<td class='numero'> " + "1" + "</td>";
                    fila += "<td class='existe' hidden> " + 1 + "</td>";
                    fila += "<td class='id_respuesta' hidden> " + id_respuesta1 + "</td>";
                    fila += "<td class='tex comentario'> " + "Verdadero" + "</td>";
                    fila += "<td class='vedadero_falso'> " + select1 + "</td>";
                    fila += "<td> " + eliminar1 + "</td>";
                    fila += "</tr>";
                    $("#respuestas_pre").append(fila);
                    $(".select").select2();
                    let fila2 = "<tr class='respu' id='" + id_respuesta2 + "'>";
                    fila2 += "<td class='numero'> " + "2" + "</td>";
                    fila += "<td class='existe' hidden> " + 1 + "</td>";
                    fila += "<td class='id_respuesta' hidden> " + id_respuesta2 + "</td>";
                    fila2 += "<td class='tex comentario'> " + "Falso" + "</td>";
                    fila2 += "<td class='vedadero_falso'> " + select2 + "</td>";
                    fila2 += "<td> " + eliminar2 + "</td>";
                    fila2 += "</tr>";
                    $("#respuestas_pre").append(fila2);
                    $(".select").select2();
                    display_notify(datax.typeinfo, datax.msg);
                } else {
                    var i = 0;
                    var msg = "";
                    var error = false;
                    var array_json = new Array();
                    $("#respuestas_pre tr").each(function(index) {
                        var id = $(this).find(".id_respuesta").text();
                        var descripcion = $(this).find(".comentario").text();
                        var existe = $(this).find(".existe").text();
                        var tipo = $(this).find("#tipo :selected").val();
                        var obj = new Object();
                        obj.id = id;
                        obj.descripcion = descripcion;
                        obj.existe = existe;
                        obj.tipo = tipo;
                        //convert object to json string
                        text = JSON.stringify(obj);
                        array_json.push(text);
                        i = i + 1;
                    });
                    json_arr = '[' + array_json + ']';
                    if (i == 0) {
                        error = true
                    }
                    var dataString = 'process=actualizar_respuestas';
                    dataString += '&id_pregunta=' + id_pregunta;
                    dataString += '&json_arr=' + json_arr;
                    $.ajax({
                        type: 'POST',
                        url: "agregar_pregunta_respuesta.php",
                        data: dataString,
                        dataType: 'json',
                        async: false,
                        success: function(datax) {
                            display_notify(datax.typeinfo, datax.msg);
                        }
                    });
                }
            } else {
                display_notify(datax.typeinfo, datax.msg);
            }
        }
    });
}

/** FUNCION PARA VALIDAR UN CLIC SOBRE UN TD */
function campos(td, valores, col, row) {

    if ($(td).hasClass('ed')) {
        var av = $(td).html();
        $(td).html('');
        $(td).html('<input class="form-control in" type="text" id="value" name="value" value="" autocomplete="off">');
        $('#value').val(av);
        $('#value').focus();
        $('#value').numeric({
            negative: false,
            decimalPlaces: 2
        });
    }
    if ($(td).hasClass('vr') || $(td).hasClass('vr_hidden')) {
        console.log(valores);

        $("#modal").attr("href", "valores_referencia.php?row=" + row + "&col=" + col + "&valores=" + escape(valores) + "");
        $("#modal").click();
    }
    if ($(td).hasClass('sel')) {
        var av = $(td).html();
        $(td).html('');
        $(td).html('<select class="form-control select in" name="value" id="value" value=""><option value="" >SELECCIONAR</option><option value="UNISEX" >UNISEX</option><option value="MASCULINO" >MASCULINO</option><option value="FEMENINO" >FEMENINO</option></select>');
        $('#value').val(av);
        $('#value').focus();
    }
    if ($(td).hasClass('nm')) {
        var av = $(td).html();
        $(td).html('');
        $(td).html('<input class="form-control in cambio_porcentaje" type="text" id="value" name="value" value="" autocomplete="off">');
        $('#value').val(av);
        $('#value').focus();
        $('#value').numeric({
            negative: false,
        });
        $('.cambio_porcentaje').on('keyup', function(event) {
            totales($(this).val(), event);
        });


    }
    if ($(td).hasClass('tex')) {
        var av = $(td).html();
        $(td).html('');
        $(td).html('<input class="form-control in" type="text" id="value" name="value" value="" autocomplete="off">');
        $('#value').val(av);
        $('#value').focus();
    }

}

/* ESTA PARTE SE EJECUTARA CUANDO SE DE CLICK FUERA DE UN CAMPO */
$('html').click(function() {
    /* Aqui se esconden los menus que esten visibles (input)*/
    var fila = $('#value').parents("tr");
    if ($('#value').val() != "") {
        var valor_referencia = fila.find(".valores_referencia").text();
        var valores = valor_referencia.split("-");
        var valor0 = valores[0];
        var valor1 = valores[1];
        if (parseInt($('#value').val()) > parseInt(valor1) || parseInt($('#value').val()) < parseInt(valor0)) {
            //display_notify('Warning','Verificar el campo');
            console.log("hey");
        }

    }
    var number = $('#value').val();
    var a = $('#value').closest('td');
    var idtransace = a.closest('tr').attr('class');
    a.html(number);



});



function actualizar_tabla_general() {
    var id_evaluacion = $("#id_evaluacion").val();
    $("#preguntas_respuestas").empty();
    $.ajax({
        type: 'POST',
        url: "agregar_evaluacion.php",
        data: {
            process: 'actualizar_tabla',
            id_evaluacion: id_evaluacion,
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            $.each(datos, function(key, value) {
                var arr = Object.keys(value).map(function(k) { return value[k] });
                var fila = arr[0];
                $("#preguntas_respuestas").append(fila);
            });
        }
    });
    comprobar_preguntas();
}

function actualizar_tabla_porcentajes() {
    var id_evaluacion = $("#id_evaluacion").val();
    $("#porcentaje_respuestas").empty();
    $.ajax({
        type: 'POST',
        url: "agregar_evaluacion.php",
        data: {
            process: 'actualizar_tabla_respuestas',
            id_evaluacion: id_evaluacion,
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            $.each(datos, function(key, value) {
                var arr = Object.keys(value).map(function(k) { return value[k] });
                var fila = arr[0];
                $("#porcentaje_respuestas").append(fila);
            });
        }
    });
}



/* ESTA FUNCION SIRVE PARA ELIMINAR PREGUNTAS */
$(document).on("click", ".eliminar_pregunta", function() {
    var id = $(this).attr("id");
    swal({
            title: "Esta a punto de eliminar una pregunta",
            text: "Esta seguro de hacerlo?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                var dataString = "process=eliminar_pregunta&id_pregunta=" + id;
                $("#preguntas_respuestas tr").each(function() {
                    if ($(this).attr("id") == id) {
                        $.ajax({
                            type: 'POST',
                            url: "agregar_evaluacion.php",
                            data: dataString,
                            dataType: 'json',
                            success: function(datax) {
                                //display_notify(datax.typeinfo, datax.msg);
                                if (datax.typeinfo == "Success") {
                                    actualizar_tabla_general();
                                }
                            }
                        });
                    }
                });
            } else {
                swal("Cancelado", "Operación cancelada", "error");
                correcto++;
            }
        });
});

/* ESTA FUNCION SE EJECUTARA CADA VEZ QUE ESCONDA EL MODAL */
$(document).on('hidden.bs.modal', function(e) {
    var target = $(e.target);
    target.removeData('bs.modal').find(".modal-content").html('');
    actualizar_tabla_general();
});


/* FUNCION PARA COMPROBAR QUE HAYAN PREGUNTAS */
function comprobar_preguntas() {
    let id_evaluacion = $("#id_evaluacion").val();
    var dataString = "process=verificar_preguntas&id_evaluacion=" + id_evaluacion;
    $.ajax({
        type: 'POST',
        url: "agregar_evaluacion.php",
        data: dataString,
        async: false,
        success: function(datax) {
            $("#btn_segunda_parte").html("");
            $("#btn_segunda_parte").html(datax);
            $("#btn_siguiente_2").click(function() {
                $("#parte_2").hide();
                $("#parte_3").show();
                $("#segundo_div").hide();
                $("#tercer_div").show();
            });
            actualizar_tabla_porcentajes();
        }
    });
}

/*FUNCION TOTALES, SIRVE PARA IR CALCULANDO QUE NO SE REBASE DEL LIMITE
EL PORCENTAJE DE LAS PREGUNTAS */
function totales(monto, event) {
    if (monto == "") {
        monto = 0;
    }
    var monto_total = 0;
    let nota_maxima = $("#nota_maxima").val();
    $("#porcentaje_respuestas tr").each(function(index) {
        var monto_1 = parseFloat($(this).find("#porcentaje_p").text());
        if (isNaN(monto_1) || monto_1 == "") {
            monto_1 = 0;
        }
        if (typeof monto_1 === 'number') {
            monto_total = parseFloat(monto_total) + parseFloat(monto_1);
        }
    });
    let monto_acumulado = parseFloat(monto) + parseFloat(monto_total);
    /*alert(monto + " --- Monto");
    alert(monto_total + " --- Monto total");
    alert(monto_acumulado + " --- Monto acumulado");

    alert(nota_maxima + " --- Nota Maxima");*/
    if ((monto_acumulado) > nota_maxima) {
        let monto_nuevo = parseFloat(nota_maxima) - parseFloat(monto_total);
        $(".cambio_porcentaje").val(monto_nuevo);
        let txt = document.getElementById("comparacion_notas");
        txt.innerHTML = (nota_maxima) + " / " + (nota_maxima);
    } else {
        let txt = document.getElementById("comparacion_notas");
        txt.innerHTML = (monto_acumulado) + " / " + (nota_maxima) + " de Nota";
    }
}

/* ESTA FUNCION SIRVE PARA GUARDAR LOS PORCENTAJES DE LA EVALUACION */

function guardar_porcentajes(tipo) {
    $("html").click();
    let nota_maxima = $("#nota_maxima").val();
    let monto_total = 0;
    var i = 0;
    var msg = "";
    var error = false;
    var array_json = new Array();
    $("#porcentaje_respuestas tr").each(function(index) {
        var monto_1 = parseFloat($(this).find("#porcentaje_p").text());
        var id_respuesta = $(this).find(".id_respuesta_evaluacion").text();
        if (isNaN(monto_1) || monto_1 == "") {
            monto_1 = 0;
        }
        if (typeof monto_1 === 'number') {
            monto_total = parseFloat(monto_total) + parseFloat(monto_1);
            if (monto_1 != 0) {
                var obj = new Object();
                obj.id = id_respuesta;
                obj.porcentaje = monto_1;
                //convert object to json string
                text = JSON.stringify(obj);
                array_json.push(text);
                i = i + 1;
                json_arr = '[' + array_json + ']';
                if (i == 0) {
                    error = true
                }
            }
        }
    });
    if (error) {
        display_notify("Error", "Tiene que haber por lo menos una pregunta correcta!");
    } else {
        if (monto_total != nota_maxima) {
            display_notify("Error", "La sumatoria del procentaje de todas las respuestas correctas debe de ser igual a la nota maxima!");
        } else {
            var dataString = 'process=update_porcentajes';
            dataString += '&json_arr=' + json_arr;
            $.ajax({
                type: 'POST',
                url: "agregar_evaluacion.php",
                data: dataString,
                dataType: 'json',
                async: false,
                success: function(datax) {
                    if (datax.typeinfo == "Success") {
                        display_notify(datax.typeinfo, datax.msg);
                        if (tipo == 1) {
                            actualizar_tabla_revision();
                            $("#parte_4").show();
                            $("#parte_3").hide();
                            $("#tercer_div").hide();
                            $("#cuarto_div").show();
                        }
                    }
                }
            });
        }
    }
}
/* ESTA FUNCION SIRVE PARA ACTUALIZAR LA TABLA DE REVISION DE RESULTADOS
FINALES */
function actualizar_tabla_revision() {
    var id_evaluacion = $("#id_evaluacion").val();
    $("#revision_final").empty();
    $.ajax({
        type: 'POST',
        url: "agregar_evaluacion.php",
        data: {
            process: 'actualizar_tabla_revision',
            id_evaluacion: id_evaluacion,
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            $.each(datos, function(key, value) {
                var arr = Object.keys(value).map(function(k) { return value[k] });
                var fila = arr[0];
                $("#revision_final").append(fila);
            });
        }
    });
}
/* ESTA FUNCION SIRVE PARA GUARDAR LAS EVALUACIONES AL FINAL */
function guardar_evaluacion(tipo) {
    var id_evaluacion = $("#id_evaluacion").val();
    $.ajax({
        type: 'POST',
        url: "agregar_evaluacion.php",
        data: {
            process: 'update_evaluacion',
            id_evaluacion: id_evaluacion,
        },
        dataType: 'json',
        async: false,
        success: function(datos) {
            display_notify(datos.typeinfo, datos.msg);
            if (datos.typeinfo == "Success") {
                if (tipo == 1) {
                    setInterval("reload1();", 1500);
                }
            }
        }
    });
}
/* ESTA FUNCION SIRVE PARA RECARGAR LA PAGINA CUANDO SE 
MANDE A LLAMAR, Y REDIRIGE AL ARCHIVO admin_evaluaciones.php */
function reload1() {
    location.href = 'admin_evaluaciones.php';
}

$(function() {
    //binding event click for button in modal form
    $(document).on("click", "#btnDelete", function(event) {
        deleted();
    });

});
/* ESTA FUNCION SIRVE PARA ELIMINAR LA EVALUACION */
function deleted() {
    var id_evaluacion = $('#id_evaluacion').val();
    var dataString = 'process=deleted' + '&id_evaluacion=' + id_evaluacion;
    $.ajax({
        type: "POST",
        url: "borrar_evaluacion.php",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload1();", 1500);
                $('#viewModal1').hide();
            }
        }
    });
}
