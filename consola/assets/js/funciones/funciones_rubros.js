$(document).ready(function() {
    let base_url = $("#base_url").val();

    $('#formulario').validate({
        rules: {
            nombre: {
                required: true,
            },
            descripcion: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del rubro.",
            },
            rubro: {
                required: "Por favor ingrese la descripcion del rubro.",
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
    var descripcion = $('#descripcion').val();

    var process = $('#process').val();
    if (process == 'insert') {
        var id_rubro = 0;
        var urlprocess = base_url + '/rubros/insertar_rubro';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&descripcion=' + descripcion;
    }
    if (process == 'edited') {
        var id_rubro = $('#id_rubro').val();
        var urlprocess = base_url + '/rubros/modificar_rubro';
        var dataString = 'process=' + process + '&nombre=' + nombre + '&descripcion=' + descripcion + '&id_rubro=' + id_rubro;
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
    location.href = base_url + '/rubros';
}


function deleted() {
    let base_url = $("#base_url").val();
    var id_rubro = $('#id_rubro').val();
    var dataString = 'id_rubro=' + id_rubro;
    $.ajax({
        type: "POST",
        url: base_url + "/rubros/eliminar_rubro",
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