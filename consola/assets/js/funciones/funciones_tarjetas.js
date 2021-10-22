$(document).ready(function() {
    let base_url = $("#base_url").val();

    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre de la tarjeta.",
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

    var process = $('#process').val();
    if (process == 'insert') {
        var id_tarjeta = 0;
        var urlprocess = base_url + '/tarjetas/insertar_tarjeta';
        var dataString = 'process=' + process + '&nombre=' + nombre;
    }
    if (process == 'edited') {
        var id_tarjeta = $('#id_tarjeta').val();
        var urlprocess = base_url + '/tarjetas/modificar_tarjeta';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&id_tarjeta=' + id_tarjeta;
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
    location.href = base_url + '/tarjetas';
}


function deleted() {
    let base_url = $("#base_url").val();
    var id_tarjeta = $('#id_tarjeta').val();
    var dataString = 'id_tarjeta=' + id_tarjeta;
    $.ajax({
        type: "POST",
        url: base_url + "/tarjetas/eliminar_tarjeta",
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