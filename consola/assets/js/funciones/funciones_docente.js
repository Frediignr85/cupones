$(document).ready(function() {
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 100,
            },
            apellido: {
                required: true,
                maxlength: 250,
            },
            usuario: {
                required: true,
                maxlength: 50,
            },
            fecha: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del docente!",
                maxlength: "Longitud exede el limite de 100 caracteres!"
            },
            apellido: {
                required: "Por favor ingrese el apellido del docente!",
                maxlength: "Longitud exede el limite de 250 caracteres!"
            },
            usuario: {
                required: "Por favor ingrese el nombre de usuario del docente!",
                maxlength: "Longitud exede el limite de 50 caracteres!"
            },
            fecha: {
                required: "Por favor ingrese las fecha de nacimiento del docente!",
            },
        },
        submitHandler: function(form) {
            senddata();
        }
    });
});
$(function() {
    $(document).on("click", "#btnDelete", function(event) {
        deleted();
    });
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
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_usuario = 0;
        var urlprocess = 'agregar_docente.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + "&usuario=" + usuario + "&fecha=" + fecha;
    }
    if (process == 'edited') {
        var id_docente = $('#id_docente').val();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();

        var urlprocess = 'editar_docente.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + '&id_docente=' + id_docente + "&usuario=" + usuario + "&fecha=" + fecha
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
    location.href = 'admin_docente.php';
}

function deleted() {
    var id_docente = $('#id_docente').val();
    var dataString = 'process=deleted' + '&id_docente=' + id_docente;
    $.ajax({
        type: "POST",
        url: "borrar_docente.php",
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
            url: "admin_docente_dt.php", // json datasource
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
}
$(document).ready(function() {
    generar2();
});