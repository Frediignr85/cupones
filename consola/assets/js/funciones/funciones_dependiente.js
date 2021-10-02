$(document).ready(function() {
    let base_url = $("#base_url").val();
    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
            apellido: {
                required: true,
            },
            correo: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese los nombres del dependiente.",
            },
            apellido: {
                required: "Por favor ingrese los apellidos del dependiente.",
            },
            correo: {
                required: "Por favor ingrese el correo del dependiente.",
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

function senddata() {
    let base_url = $("#base_url").val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var correo = $("#correo").val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_dependiente = 0;
        var urlprocess = base_url + '/dependientes/insertar_dependiente';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + "&correo=" + correo;
    }
    if (process == 'edited') {
        var id_dependiente = $('#id_dependiente').val();
        var correo_viejo = $("#correo_viejo").val();
        var urlprocess = base_url + '/dependientes/modificar_dependiente';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&apellido=' + apellido + '&id_dependiente=' + id_dependiente + "&correo=" + correo + "&correo_viejo=" + correo_viejo;
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
    location.href = base_url + '/dependientes';
}


function deleted() {
    let base_url = $("#base_url").val();
    var id_dependiente = $('#id_dependiente').val();
    var dataString = 'id_dependiente=' + id_dependiente;
    $.ajax({
        type: "POST",
        url: base_url + "/dependientes/borrar_dependiente",
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