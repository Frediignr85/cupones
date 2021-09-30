$(document).ready(function() {
    generar2();
    $('#sexo').select2();
    $('.select').select2();
    $(".datapicker").datepicker({
        format: 'yyyy-mm-dd',
        language: 'es',
    });
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
            apellido: {
                required: true,
            },
            direccion: {
                required: true,
            },
            telefono: {
                required: true,
            },
            sexo: {
                required: true,
            },
            dui: {
                required: true,
            },
            tipo_empleado: {
                required: true,
            },
            fecha_nacimiento: {
                required: true,
            },
        },
        messages: {
            nombre: "Por favor ingrese el nombre de empleado",
            apellido: "Por favor ingrese el apellido de empleado",
            direccion: "Por favor ingrese la direccion de empleado",
            telefono: "Por favor ingrese el numero de telefono de  empleado",
            sexo: "Por favor ingrese genero de empleado",
            dui: "Por favor ingrese dui de empleado",
            tipo_empleado: "Por favor ingrese cargo de empleado",
            fecha_nacimiento: "Por favor ingrese fehca de nacimiento de empleado",
        },
        submitHandler: function(form) {
            senddata();
        }
    });

    $(".may").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });
    $('#tipo').select2();
    $('#producto').on('keyup', function(evt) {
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
        } else {
            $('#admin').val("1");
        }
    });
    $('#admi').on('ifUnchecked', function(event) {
        if ($("#process").val() == "permissions") {
            $('.i-checks').iCheck('uncheck');
            $('#admin').val("0");
        } else {
            $('#admin').val("0");
        }
    });
    $('#activ').on('ifChecked', function(event) {
        $('#activo').val("1");
    });
    $('#activ').on('ifUnchecked', function(event) {
        $('#activo').val("0");
    });
});

$(function() {
    $(document).on("click", "#anular", function(event) {
        estado();
    });
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
    /*var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var direccion = $('#direccion').val();
    var telefono = $('#telefono').val();
    var sexo = $('#sexo').val();
    var dui = $('#dui').val();
    var tipo = $('#tipo_empleado').val();
    var fecha_nacimiento = $('#fecha_na').val();
    var cargo = $('#id_cargo_empleado').val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_empleado = 0;
        var urlprocess = 'agregar_empleado.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + '&direccion=' + direccion + '&telefono=' + telefono + '&sexo=' + sexo + '&dui=' + dui + '&fecha_na=' + fecha_nacimiento + '&tipo=' + tipo;
    }
    if (process == 'edited') {
        var id_empleado = $('#id_empleado').val();
        var urlprocess = 'editar_empleado.php';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + '&direccion=' + direccion + '&telefono=' + telefono + '&sexo=' + sexo + '&dui=' + dui + '&fecha_na=' + fecha_nacimiento + '&tipo=' + tipo + '&id_empleado=' + id_empleado + '&cargo=' + cargo;
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
                setInterval("reload();", 1500);
            }
        }
    });*/

    var process = $('#process').val();
    if (process == 'insert') {
        var urlprocess = 'agregar_empleado.php';
    }
    if (process == 'edited') {
        var urlprocess = 'editar_empleado.php';
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
    var form = $("#formulario");
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }
    var formAction = form.attr('action');
    $.ajax({
        type: 'POST',
        url: urlprocess,
        cache: false,
        data: formdata ? formdata : form.serialize(),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            display_notify(data.typeinfo, data.msg, data.process);
            if (data.typeinfo == "Success") {
                setInterval("reload();", 1500);
            }
        }
    });
}

function reload() {
    location.href = 'admin_empleado.php';
}

function estado() {
    var id_empleado = $('#id_empleado').val();
    var estado = $('#estado').val();
    var dataString = 'process=anular' + '&id_empleado=' + id_empleado + '&estado=' + estado;
    $.ajax({
        type: "POST",
        url: "estado_empleado.php",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload();", 1500);
                $('#deleteModal').hide();
            }
        }
    });
}

function deleted() {
    var id_producto = $('#id_producto').val();
    var dataString = 'process=deleted' + '&id_producto=' + id_producto;
    $.ajax({
        type: "POST",
        url: "borrar_producto.php",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload();", 1500);
                $('#deleteModal').hide();
            }
        }
    });
}

function ver() {
    var id_empleado = $('#id_empleado').val();
    var dataString = 'process=ver' + '&id_empleado=' + id_empleado;
    $.ajax({
        type: "POST",
        url: "ver_producto.php",
        data: dataString,
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload();", 1500);
                $('#verModal').hide();
            }
        }
    });
}
$('#telefono').on('keydown', function(event) {
    if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

    } else {
        if ((event.keyCode > 47 && event.keyCode < 60) || (event.keyCode > 95 && event.keyCode < 106)) {
            inputval = $(this).val();
            var string = inputval.replace(/[^0-9]/g, "");
            var bloc1 = string.substring(0, 4);
            var bloc2 = string.substring(4, 7);
            var string = bloc1 + "-" + bloc2;
            $(this).val(string);
        } else {
            event.preventDefault();
        }

    }
});
$('#dui').on('keydown', function(event) {
    if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

    } else {
        if ((event.keyCode > 47 && event.keyCode < 60) || (event.keyCode > 95 && event.keyCode < 106)) {
            inputval = $(this).val();
            var string = inputval.replace(/[^0-9]/g, "");
            var bloc1 = string.substring(0, 8);
            var bloc2 = string.substring(8, 8);
            var string = bloc1 + "-" + bloc2;
            $(this).val(string);
        } else {
            event.preventDefault();
        }

    }
});

function generar2() {

    dataTable = $('#editable2').DataTable().destroy()
    dataTable = $('#editable2').DataTable({
        "pageLength": 50,
        "order": [0, 'desc'],
        "processing": true,
        "serverSide": true,
        "autoWidth": false,
        "ajax": {
            url: "admin_empleado_dt.php", // json datasource
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