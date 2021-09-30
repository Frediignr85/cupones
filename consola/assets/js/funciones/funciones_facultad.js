$(document).ready(function() {
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 100,
            },
            descripcion: {
                maxlength: 250,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre de la facultad!!",
                maxlength: "Longitud exede el limite de 100 caracteres!"
            },
            descripcion: {
                maxlength: "Longitud exede el limite de 250 caracteres"
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
    var descripcion = $('#descripcion').val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_usuario = 0;
        var urlprocess = 'agregar_facultad.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&descripcion=' + descripcion;
    }
    if (process == 'edited') {
        var id_facultad = $('#id_facultad').val();
        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();

        var urlprocess = 'editar_facultad.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&descripcion=' + descripcion + '&id_facultad=' + id_facultad;
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
    location.href = 'admin_facultad.php';
}

function deleted() {
    var id_facultad = $('#id_facultad').val();
    var dataString = 'process=deleted' + '&id_facultad=' + id_facultad;
    $.ajax({
        type: "POST",
        url: "borrar_facultad.php",
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
    dataTable = $('#editable2').DataTable().destroy();
    dataTable = $('#editable2').DataTable({
        "pageLength": 50,
        "order": [0, 'desc'],
        "processing": true,
        "autoWidth": false,
        "serverSide": true,
        "ajax": {
            url: "admin_facultad_dt.php", // json datasource
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