$(document).ready(function() {

    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
            usuario: {
                required: true,
            },
            clave: {
                required: true,
            },
        },
        messages: {
            nombre: "Por favor ingrese el nombre del usuario",
            usuario: "Por favor ingrese el usuario",
            clave: "Por favor ingrese la clave",
        },
        submitHandler: function(form) {
            senddata();
        }
    });

    $('.select').select2();
    $('#usuario').on('keyup', function(evt) {
        if (evt.keyCode == 32) {
            $(this).val($(this).val().replace(" ", ""));
        } else {
            $(this).val($(this).val().toLowerCase());
        }
    });
    $('#admi').on('ifChecked', function(event) {
        if ($("#process").val() == "permissions") {
            $('.i-checks').iCheck('check');
            $('#admin').val("1");
        }
    });
    $('#admi').on('ifUnchecked', function(event) {
        if ($("#process").val() == "permissions") {
            $('.i-checks').iCheck('uncheck');
            $('#admin').val("2");
        }
    });
    $('#activ').on('ifChecked', function(event) {
        $('#activo').val("1");
    });
    $('#activ').on('ifUnchecked', function(event) {
        $('#activo').val("0");
    });
    $('#adminx').on('ifChecked', function(event) {
        $('#adminsx').val("1");
    });
    $('#adminx').on('ifUnchecked', function(event) {
        $('#adminsx').val("0");
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

function senddata() {
    var nombre = $('#nombre').val();
    var usuario = $('#usuario').val();
    var clave = $('#clave').val();
    var admin = $('#adminsx').val();
    var activo = $('#activo').val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_usuario = 0;
        var urlprocess = 'agregar_usuario.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&usuario=' + usuario + '&clave=' + clave + '&admin=' + admin + '&activo=' + activo;
    }
    if (process == 'edited') {
        var id_usuario = $('#id_usuario').val();
        var urlprocess = 'editar_usuario.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&usuario=' + usuario + '&clave=' + clave + '&admin=' + admin + '&id_usuario=' + id_usuario + '&activo=' + activo;
    }
    if (process == 'permissions') {
        var id_usuario = $('#id_usuario').val();
        var urlprocess = 'permiso_usuario.php';
        var myCheckboxes = new Array();
        var cuantos = 0;
        var chequeado = false;
        var admin = $("#admin").val();
        $("input[name='myCheckboxes']:checked").each(function(index) {
            var est = $('#myCheckboxes').eq(index).attr('checked');
            chequeado = true;
            myCheckboxes.push($(this).val());
            cuantos = cuantos + 1;
        });
        if (cuantos == 0) {
            myCheckboxes = '0';
        }

        var dataString = 'process=' + process + '&admin=' + admin + '&id_usuario=' + id_usuario + '&myCheckboxes=' + myCheckboxes + '&qty=' + cuantos;
        //alert(dataString);
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
    location.href = 'admin_usuario.php';
}

function deleted() {
    var id_usuario = $('#id_usuario').val();
    var dataString = 'process=deleted' + '&id_usuario=' + id_usuario;
    $.ajax({
        type: "POST",
        url: "borrar_usuario.php",
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
            url: "admin_usuario_dt.php", // json datasource
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