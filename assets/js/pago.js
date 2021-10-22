$(document).ready(function() {

    $('#numero_tarjeta').on('keydown', function(event) {
        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

        } else {
            if ((event.keyCode > 47 && event.keyCode < 60) || (event.keyCode > 95 && event.keyCode < 106)) {
                inputval = $(this).val();
                var string = inputval.replace(/[^0-9]/g, "");
                var bloc1 = string.substring(0, 4);
                var bloc2 = string.substring(4, 8);
                var bloc3 = string.substring(8, 12);
                var bloc4 = string.substring(12, 15);
                var string = bloc1 + " " + bloc2 + " " + bloc3 + " " + bloc4;
                $(this).val(string);
            } else {
                event.preventDefault();
            }
        }
    });
    $('#ccv_tarjeta').on('keydown', function(event) {
        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

        } else {
            if ((event.keyCode > 47 && event.keyCode < 60) || (event.keyCode > 95 && event.keyCode < 106)) {
                inputval = $(this).val();
                var string = inputval.replace(/[^0-9]/g, "");
                var bloc1 = string.substring(0, 2);
                var string = bloc1;
                $(this).val(string);
            } else {
                event.preventDefault();
            }
        }
    });
    $('#expiracion_tajeta').on('keydown', function(event) {
        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

        } else {
            if ((event.keyCode > 47 && event.keyCode < 60) || (event.keyCode > 95 && event.keyCode < 106)) {
                inputval = $(this).val();
                var string = inputval.replace(/[^0-9]/g, "");
                var bloc1 = string.substring(0, 2);
                var bloc2 = string.substring(2, 3);
                var string = bloc1 + "/" + bloc2;
                $(this).val(string);
            } else {
                event.preventDefault();
            }
        }
    });

    var viewMode = getCookie("view-mode");
    if (viewMode == "desktop") {
        viewport.setAttribute('content', 'width=1024');
    } else if (viewMode == "mobile") {
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    }
});


$("#btn_pagar").click(function() {
    let base_url = $("#base_url").val();
    let id_tarjeta = $("#id_tarjeta").val();
    let numero_tarjeta = $("#numero_tarjeta").val();
    let propietario_tarjeta = $("#propietario_tarjeta").val();
    let ccv_tarjeta = $("#ccv_tarjeta").val();
    let expiracion_tajeta = $("#expiracion_tajeta").val();
    let error = false;
    let msg = "";
    if (id_tarjeta == "") {
        error = true;
        msg = "Introduzca la tarjeta que utilizara para el pago!";

    } else if (numero_tarjeta == "") {
        error = true;
        msg = "Introduzca el numero de la tarjeta!";
    } else if (propietario_tarjeta == "") {
        error = true;
        msg = "Introduzca el nombre del propietario de la tarjeta!";
    } else if (ccv_tarjeta == "") {
        error = true;
        msg = "Introduzca el CCV de la tarjeta.";
    } else if (expiracion_tajeta == "") {
        error = true;
        msg = "Introduzca la fecha de expiracion de la tarjeta";
    }
    if (!error) {
        $.ajax({
            type: 'POST',
            url: base_url + "/pago/pagar",
            data: {
                id_tarjeta: id_tarjeta,
                numero_tarjeta: numero_tarjeta,
                propietario_tarjeta: propietario_tarjeta,
                ccv_tarjeta: ccv_tarjeta,
                expiracion_tajeta: expiracion_tajeta,
            },
            dataType: 'json',
            async: false,
            success: function(datax) {
                if (datax.typeinfo == "Success") {
                    swal({
                        title: "Exito!",
                        text: datax.msg,
                        icon: "success",
                        button: "Ok!",
                    });
                    window.open("imprimir_reporte?id_compra_general=" + datax.id_compra_general + "", '_blank');
                    setInterval("reload1();", 1500);
                } else {
                    swal({
                        title: "Error!",
                        text: datax.msg,
                        icon: "error",
                        button: "Ok!",
                    });
                }
            }
        });
    } else {
        swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
        });
    }


});

function reload1() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/inicio';
}