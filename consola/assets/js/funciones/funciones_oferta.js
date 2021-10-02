$(document).ready(function() {
    let base_url = $("#base_url").val();
    $('.precios').numeric({
        negative: false,
    });
    $('#cantidad').numeric({
        negative: false,
        decimal: false,
    });
    $('#formulario').validate({
        rules: {
            titulo: {
                required: true,
            },
            descripcion: {
                required: true,
            },
            precio_regular: {
                required: true,
            },
            precio_oferta: {
                required: true,
            },
            cantidad: {
                required: true,
            },
            fecha_inicio: {
                required: true,
            },
            fecha_fin: {
                required: true,
            },
            fecha_limite: {
                required: true,
            },
        },
        messages: {
            titulo: {
                required: "Por favor ingrese el titulo de la oferta.",
            },
            descripcion: {
                required: "Por favor ingrese la descripcion de la oferta.",
            },
            precio_regular: {
                required: "Por favor ingrese el precio regular de la oferta.",
            },
            precio_oferta: {
                required: "Por favor ingrese el precio ofertado de la oferta.",
            },
            cantidad: {
                required: "Por favor ingrese la cantidad de cupones limite.",
            },
            fecha_inicio: {
                required: "Por favor ingrese la fecha de inicio de la oferta.",
            },
            fecha_fin: {
                required: "Por favor ingrese la fecha de finalizacion de la oferta.",
            },
            fecha_limite: {
                required: "Por favor ingrese la fecha limite de la oferta.",
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
    $(document).on("click", "#btnRechazar", function(event) {
        rechazar();
    });
    $(document).on("click", "#btnAprobar", function(event) {
        aprobar();
    });
    $(document).on("click", "#btnDescartar", function(event) {
        descartar();
    });
    $(document).on('hidden.bs.modal', function(e) {
        var target = $(e.target);
        target.removeData('bs.modal').find(".modal-content").html('');
    });
});

function senddata() {
    let base_url = $("#base_url").val();
    var titulo = $('#titulo').val();
    var descripcion = $('#descripcion').val();
    var precio_regular = $("#precio_regular").val();
    var precio_oferta = $("#precio_oferta").val();
    var cantidad = $("#cantidad").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var fecha_limite = $("#fecha_limite").val();
    var detalles = $("#detalles").val();
    //Get the value from form if edit or insert
    var process = $('#process').val();
    if (process == 'insert') {
        var id_oferta = 0;
        var urlprocess = base_url + '/ofertas/insertar_oferta';
        var dataString = 'process=' + process + '&titulo=' + titulo + '&descripcion=' + descripcion + "&precio_regular=" + precio_regular + "&precio_oferta=" + precio_oferta + "&cantidad=" + cantidad + "&fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin + "&fecha_limite=" + fecha_limite + "&detalles=" + detalles;
    }
    if (process == 'edited') {
        var id_oferta = $('#id_oferta').val();
        var urlprocess = base_url + '/ofertas/modificar_oferta';
        var dataString = 'process=' + process + '&titulo=' + titulo + '&descripcion=' + descripcion + '&id_oferta=' + id_oferta + "&precio_regular=" + precio_regular + "&precio_oferta=" + precio_oferta + "&cantidad=" + cantidad + "&fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin + "&fecha_limite=" + fecha_limite + "&detalles=" + detalles;
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
    location.href = base_url + '/dashboard';
}


function deleted() {
    let base_url = $("#base_url").val();
    var id_oferta = $('#id_oferta').val();
    var dataString = 'id_oferta=' + id_oferta;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/borrar_oferta",
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


function aprobar() {
    let base_url = $("#base_url").val();
    var id_oferta = $('#id_oferta').val();
    var dataString = 'id_oferta=' + id_oferta;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/aprobar_oferta",
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

function rechazar() {
    let base_url = $("#base_url").val();
    var id_oferta = $('#id_oferta').val();
    var justificacion = $('#justificacion').val();
    var dataString = 'id_oferta=' + id_oferta + "&justificacion=" + justificacion;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/rechazar_oferta",
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

function descartar() {
    let base_url = $("#base_url").val();
    var id_oferta = $('#id_oferta').val();
    var dataString = 'id_oferta=' + id_oferta;
    $.ajax({
        type: "POST",
        url: base_url + "/ofertas/descartar_oferta",
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