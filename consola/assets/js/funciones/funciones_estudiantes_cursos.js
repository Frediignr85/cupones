var urlprocess_enviar = 'estudiantes_cursos.php';

$(document).ready(function() {
    let id_curso = $("#id_curso").val();
    $("#estudiante_buscar").typeahead({
        source: function(query, process) {
            $.ajax({
                type: 'POST',
                url: 'buscar_estudiante.php',
                data: 'query=' + query,
                dataType: 'JSON',
                async: false,
                success: function(data) {
                    process(data);
                }
            });
        },
        updater: function(selection) {
            var prod0 = selection;
            var prod = prod0.split("|");
            var id_estudiante = prod[0];
            var nombre_estudiante = prod[1];
            var codigo = prod[2];
            var fecha_inscripcion = prod[3];
            var igual = 0;

            $("#inventable tr").each(function(index) {
                var id = $(this).find(".id_estudiante").text();
                if (id == id_estudiante) {
                    igual++;
                }
            });

            if (igual == 0) {
                $.ajax({
                    type: 'POST',
                    url: urlprocess_enviar,
                    data: {
                        process: 'consultar_existencia',
                        id_estudiante: id_estudiante,
                        id_curso: id_curso
                    },
                    dataType: 'JSON',
                    async: false,
                    success: function(resultado) {
                        if (resultado.typeinfo == "Error") {
                            display_notify("Error", resultado.msg);
                        } else {
                            addEstudianteList(id_estudiante, nombre_estudiante, codigo, fecha_inscripcion);
                        }
                    }
                });
            } else {
                display_notify("Error", "Ya se agrego el estudiante a la tabla!");
            }
        }
    });
    traer_estudiantes();
    $(document).keydown(function(e) {
        if (e.which == 113) { //F2 Guardar
            e.stopPropagation();
            senddata();
        }
        if (e.which == 115) { //F2 Guardar
            e.stopPropagation();
            location.replace('dashboard.php');
        }
    });
});
//funcion recoger insumos de una microcirugia y mostrarlos en DOM
function traer_estudiantes() {
    var id_curso = $("#id_curso").val();
    //encabezado y detalle orden
    var n = 0;
    $.ajax({
        type: 'POST',
        url: urlprocess_enviar,
        data: {
            process: 'traer_estudiantes',
            id_curso: id_curso,
        },
        dataType: 'json',
        success: function(datos) {
            $.each(datos, function(key, value) {
                n = n + 1;
                var arr = Object.keys(value).map(function(k) { return value[k] });
                var id_estudiante = arr[0];
                var nombre_estudiante = arr[1];
                var codigo = arr[2];
                var fecha_inscripcion = arr[3];
                addEstudianteList(id_estudiante, nombre_estudiante, codigo, fecha_inscripcion);
            });
        }
    });
}


// Evento que selecciona la fila y la elimina de la tabla
$(document).on("click", ".Delete", function() {
    var tr = $(this).parents("tr");
    tr.remove();
});

// actualize table data to server
$(document).on("click", "#submit1", function() {
    senddata();
});
$(document).on("click", "#btnEsc", function(event) {
    reload1();
});

function senddata() {
    //Obtener los valores a guardar de cada item facturado
    let id_curso = $("#id_curso").val();
    var i = 0;
    var msg = "";
    var error = false;
    var array_json = new Array();
    $("#inventable tr").each(function(index) {
        var id = $(this).find(".id_estudiante").text();
        var obj = new Object();
        obj.id = id;
        //convert object to json string
        text = JSON.stringify(obj);
        array_json.push(text);
        i = i + 1;
    });
    json_arr = '[' + array_json + ']';
    if (i == 0) {
        error = true
    }

    var dataString = 'process=insert';
    dataString += '&id_curso=' + id_curso;
    dataString += '&json_arr=' + json_arr;

    $("#inventable tr").remove();
    $.ajax({
        type: 'POST',
        url: urlprocess_enviar,
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            if (datax.typeinfo == "Success") {
                display_notify(datax.typeinfo, datax.msg);
                setInterval("reload1();", 1500);
            }
        }
    });
}


function reload1() {
    location.href = 'admin_curso.php';
}


function addEstudianteList(id_estudiante, nombre_estudiante, codigo, fecha_inscripcion) {
    var tr_add = "";
    tr_add += "<tr class='row100 head ESTUDIANTE' id='" + id_estudiante + "'>";
    tr_add += "<td hidden style=\"display:none;\" class='id_estudiante'>" + id_estudiante + "</td>";
    tr_add += "<td style=\"text-align:left;\"  class='cell100 column16 text-left codigo'>" + codigo + "</td>";
    tr_add += "<td  style=\"text-align:left;\"  class='cell100 column40 text-left nombre'>" + nombre_estudiante + "</td>";
    tr_add += "<td  style=\"text-align:left;\"   class='cell100 column40 text-left fecha'>" + fecha_inscripcion + "</td>";
    tr_add += '<td  class="cell100 column4 text-left"><input id="delprod" type="button" class="btn btn-danger fa Delete"  value="&#xf1f8;"></td>';
    tr_add += '</tr>';
    $("#inventable").prepend(tr_add);
    scrolltable();

}

function valideKey(evt) {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}