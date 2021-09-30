$(document).ready(function() {
    $(".select").select2();
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 100,
            },
            apellido: {
                required: true,
                maxlength: 100,
            },
            usuario: {
                required: true,
                maxlength: 50,
            },
            fecha: {
                required: true,
            },
            departamento: {
                required: true,
            },
            municipio: {
                required: true,
            },
            facultad: {
                required: true,
            },
            carrera: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del estudiante!",
                maxlength: "Longitud exede el limite de 100 caracteres!"
            },
            apellido: {
                required: "Por favor ingrese el apellido del estudiante!",
                maxlength: "Longitud exede el limite de 100 caracteres!"
            },
            usuario: {
                required: "Por favor ingrese el nombre de usuario del estudiante!",
                maxlength: "Longitud exede el limite de 50 caracteres!"
            },
            fecha: {
                required: "Por favor ingrese la fecha de nacimiento del estudiante!",
            },
            departamento: {
                required: "Por favor ingrese el departamento donde vive el estudiante!",
            },
            municipio: {
                required: "Por favor ingrese el municipio donde vive el estudiante!",
            },
            facultad: {
                required: "Por favor ingrese la facultad a la que pertenece el estudiante!",
            },
            carrera: {
                required: "Por favor ingrese la carrera a la que pertenece el estudiante!",
            },
        },
        submitHandler: function(form) {
            senddata();
        }
    });

    $("#departamento").change(function() {
        $("#municipio *").remove();
        $("#select2-municipio-container").text("");
        var ajaxdata = { "process": "municipio", "id_departamento": $("#departamento").val() };
        $.ajax({
            url: "agregar_estudiante.php",
            type: "POST",
            data: ajaxdata,
            success: function(opciones) {
                $("#select2-municipio-container").text("Seleccione");
                $("#municipio").html(opciones);
                $("#municipio").val("");
            }
        })
    });

    $("#facultad").change(function() {
        $("#carrera *").remove();
        $("#select2-carrera-container").text("");
        var ajaxdata = { "process": "carrera", "id_facultad": $("#facultad").val() };
        $.ajax({
            url: "agregar_estudiante.php",
            type: "POST",
            data: ajaxdata,
            success: function(opciones) {
                $("#select2-carrera-container").text("Seleccione");
                $("#carrera").html(opciones);
                $("#carrera").val("");
            }
        })
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
    var apellido = $('#apellido').val();
    var usuario = $("#usuario").val();
    var fecha = $("#fecha").val();
    var departamento = $("#departamento").val();
    var municipio = $("#municipio").val();
    var facultad = $("#facultad").val();
    var carrera = $("#carrera").val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_usuario = 0;
        var urlprocess = 'agregar_estudiante.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + "&usuario=" + usuario + "&fecha=" + fecha;
        dataString += "&departamento=" + departamento + "&municipio=" + municipio + "&facultad=" + facultad + "&carrera=" + carrera;
    }
    if (process == 'edited') {
        var id_estudiante = $('#id_estudiante').val();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();

        var urlprocess = 'editar_estudiante.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + '&id_estudiante=' + id_estudiante + "&usuario=" + usuario + "&fecha=" + fecha;
        dataString += "&departamento=" + departamento + "&municipio=" + municipio + "&facultad=" + facultad + "&carrera=" + carrera;
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
    location.href = 'admin_estudiante.php';
}

function deleted() {
    var id_estudiante = $('#id_estudiante').val();
    var dataString = 'process=deleted' + '&id_estudiante=' + id_estudiante;
    $.ajax({
        type: "POST",
        url: "borrar_estudiante.php",
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
            url: "admin_estudiante_dt.php", // json datasource
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