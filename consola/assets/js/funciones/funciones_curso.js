$(document).ready(function() {
    $(".select").select2();
    $("#hora_inicio").timepicki();
    $("#hora_fin").timepicki();
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 100,
            },
            materia: {
                required: true,
            },
            docente: {
                required: true,
            },
            estado: {
                required: true,
            },
            fecha_inicio: {
                required: true,
            },
            hora_inicio: {
                required: true,
            },
            fecha_fin: {
                required: true,
            },
            hora_fin: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del curso!",
                maxlength: "Longitud exede el limite de 100 caracteres!"
            },
            materia: {
                required: "Por favor ingrese la materia asociada!",
            },
            docente: {
                required: "Por favor ingrese el docente asociado!",
            },
            estado: {
                required: "Por favor ingrese el estado del curso!",
            },
            fecha_inicio: {
                required: "Por favor ingrese la estado de inicio del curso!",
            },
            hora_inicio: {
                required: "Por favor ingrese la hora de inicio del curso!",
            },
            fecha_fin: {
                required: "Por favor ingrese la estado de finalizacion del curso!",
            },
            hora_fin: {
                required: "Por favor ingrese la hora de finalizacion del curso!",
            },
        },
        submitHandler: function(form) {
            senddata();
        }
    });

});

$(function() {
    //binding event click for button in modal form
    $(document).on("click", "#btnDelete", function(event) {
        deleted();
    });
    // Clean the modal form
    $(document).on('hidden.bs.modal', function(e) {
        var target = $(e.target);
        target.removeData('bs.modal').find(".modal-content").html('');
    });

});

function autosave(val) {
    var name = $('#name').val();
    if (name == '' || name.length == 0) {
        var typeinfo = "Info";
        var msg = "The field name is required";
        display_notify(typeinfo, msg);
        $('#name').focus();
    } else {
        senddata();
    }
}

function senddata() {
    var nombre = $('#nombre').val();
    var materia = $('#materia').val();
    var docente = $("#docente").val();
    var estado = $("#estado").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var hora_inicio = $("#hora_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var hora_fin = $("#hora_fin").val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_usuario = 0;
        var urlprocess = 'agregar_curso.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&materia=' + materia + "&docente=" + docente + "&estado=" + estado;
        dataString += "&fecha_inicio=" + fecha_inicio + "&hora_inicio=" + hora_inicio + "&fecha_fin=" + fecha_fin + "&hora_fin=" + hora_fin;
    }
    if (process == 'edited') {
        var id_curso = $('#id_curso').val();
        var nombre = $('#nombre').val();
        var materia = $('#materia').val();

        var urlprocess = 'editar_curso.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&materia=' + materia + '&id_curso=' + id_curso + "&docente=" + docente + "&estado=" + estado;
        dataString += "&fecha_inicio=" + fecha_inicio + "&hora_inicio=" + hora_inicio + "&fecha_fin=" + fecha_fin + "&hora_fin=" + hora_fin;
    }
    $.ajax({
        type: 'POST',
        url: urlprocess,
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            process = datax.process;
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload1();", 1500);
            }
        }
    });
}

function reload1() {
    location.href = 'admin_curso.php';
}

function deleted() {
    var id_curso = $('#id_curso').val();
    var dataString = 'process=deleted' + '&id_curso=' + id_curso;
    $.ajax({
        type: "POST",
        url: "borrar_curso.php",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload1();", 1500);
                $('#deleteModal').hide();
            }
        }
    });
}

function generar2() {
    dataTable = $('#editable2').DataTable().destroy()
    dataTable = $('#editable2').DataTable({
        "pageLength": 50,
        "order": [0, 'desc'],
        "processing": true,
        "autoWidth": false,
        "serverSide": true,
        "ajax": {
            url: "admin_curso_dt.php", // json datasource
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

$(document).ready(function() {
    generar2();
});