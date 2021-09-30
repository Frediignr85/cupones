$(document).ready(function() {
    let base_url = $("#base_url").val();
    $('#porcentaje').numeric({
        negative: false,
    });
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
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
            rubro: {
                required: true,
            },
            encargado: {
                required: true,
            },
            telefono: {
                required: true,
            },
            correo: {
                required: true,
            },
            departamento: {
                required: true,
            },
            municipio: {
                required: true,
            },
            porcentaje: {
                required: true,
            },
            direccion: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre de la empresa.",
            },
            rubro: {
                required: "Por favor ingrese el rubro de la empresa.",
            },
            encargado: {
                required: "Por favor ingrese el nombre del encargado de la empresa.",
            },
            telefono: {
                required: "Por favor ingrese el telefono de contacto de la empresa.",
            },
            correo: {
                required: "Por favor ingrese el correo de contacto de la empresa.",
            },
            departamento: {
                required: "Por favor ingrese el departamento de la empresa.",
            },
            municipio: {
                required: "Por favor ingrese el municipio de la empresa.",
            },
            porcentaje: {
                required: "Por favor ingrese el porcentaje de comision.",
            },
            direccion: {
                required: "Por favor ingrese la direccion de la empresa.",
            },
        },
        submitHandler: function(form) {
            senddata();
        }
    });
    $(".select").select2();

    $("#departamento").change(function() {
        $("#municipio *").remove();
        $("#select2-municipio-container").text("");
        var ajaxdata = { "id_departamento": $("#departamento").val() };
        $.ajax({
            url: base_url + "/empresa/municipio/",
            type: "POST",
            data: ajaxdata,
            success: function(opciones) {
                $("#select2-municipio-container").text("Seleccione");
                $("#municipio").html(opciones);
                $("#municipio").val("");
            }
        })
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

function senddata() {
    let base_url = $("#base_url").val();
    var nombre = $('#nombre').val();
    var rubro = $('#rubro').val();
    var encargado = $("#encargado").val();
    var telefono = $("#telefono").val();
    var correo = $("#correo").val();
    var departamento = $("#departamento").val();
    var municipio = $("#municipio").val();
    var porcentaje = $("#porcentaje").val();
    var direccion = $("#direccion").val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_empresa = 0;
        var urlprocess = base_url + '/empresa/insertar_empresa';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&rubro=' + rubro + "&encargado=" + encargado + "&telefono=" + telefono + "&correo=" + correo + "&departamento=" + departamento + "&municipio=" + municipio + "&porcentaje=" + porcentaje + "&direccion=" + direccion;
    }
    if (process == 'edited') {
        var id_empresa = $('#id_empresa').val();
        var urlprocess = base_url + '/empresa/modificar_empresa';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&rubro=' + rubro + '&id_empresa=' + id_empresa + "&encargado=" + encargado + "&telefono=" + telefono + "&correo=" + correo + "&departamento=" + departamento + "&municipio=" + municipio + "&porcentaje=" + porcentaje + "&direccion=" + direccion;
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
    let base_url = $("#base_url").val();
    location.href = base_url + '/empresa';
}


function deleted() {
    let base_url = $("#base_url").val();
    var id_empresa = $('#id_empresa').val();
    var dataString = 'id_empresa=' + id_empresa;
    $.ajax({
        type: "POST",
        url: base_url + "/empresa/borrar_empresa",
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