$(".remove__cart-item").click(function() {
    let id_carrito = $(this).attr("id_carrito");
    let base_url = $("#base_url").val();
    $.ajax({
        type: 'POST',
        url: base_url + "/carrito/eliminar_item",
        data: {
            id_carrito: id_carrito,
        },
        dataType: 'json',
        async: false,
        success: function(datax) {
            if (datax.typeinfo == "Success") {
                $("#cart__total").text(datax.total_productos);
                $("#productos_total").text(datax.total_productos);
                $("#precio_total").text(datax.total_final);
                $("#" + id_carrito).remove();
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
});

$(".minus-btn").click(function() {
    let id_carrito = $(this).attr("id_carrito");
    let cantidad = $("#carrito_" + id_carrito).val();
    if (cantidad > 1) {
        cantidad--;
        cambia(id_carrito, cantidad);
    }
    $("#carrito_" + id_carrito).val(cantidad);
});
$(".plus-btn").click(function() {
    let id_carrito = $(this).attr("id_carrito");
    let cantidad_cupones = $(this).attr("cantidad_cupones");
    let cantidad = $("#carrito_" + id_carrito).val();
    parseInt(cantidad);
    cantidad++;
    if (cantidad_cupones != "Ilimitados") {
        parseInt(cantidad_cupones);
        if (cantidad <= cantidad_cupones) {
            $("#carrito_" + id_carrito).val(cantidad);
            cambia(id_carrito, cantidad);
        }
    } else {
        $("#carrito_" + id_carrito).val(cantidad);
        cambia(id_carrito, cantidad);
    }

});



function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
        return false;
    } else {
        return true;
    }
}
$(".counter-btn").on("input", function(e) {
    let cantidad_cupones = $(this).attr("cantidad_cupones");
    let id_carrito = $(this).attr("id_carrito");
    let cantidad = $(this).val();
    if (cantidad == "") {
        $(this).val("1");
        cambia(id_carrito, 1);
    } else {
        if (cantidad_cupones != "Ilimitados") {
            cantidad_cupones = parseInt(cantidad_cupones);
            cantidad = parseInt(cantidad);
            if (cantidad > cantidad_cupones) {
                $(this).val(cantidad_cupones);
                cambia(id_carrito, cantidad_cupones);
            } else {
                cambia(id_carrito, cantidad);
            }
        }
    }
});

function cambia(id_carrito, cantidad) {
    let base_url = $("#base_url").val();
    $.ajax({
        type: 'POST',
        url: base_url + "/carrito/actualizar_cantidad",
        data: {
            id_carrito: id_carrito,
            cantidad: cantidad,
        },
        dataType: 'json',
        async: false,
        success: function(datax) {
            if (datax.typeinfo == "Success") {
                $("#cart__total").text(datax.total_productos);
                $("#precio_oferta" + id_carrito).text(datax.total_oferta);
                $("#productos_total").text(datax.total_productos);
                $("#precio_total").text(datax.total_final);
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
}

$(document).ready(function() {
    var viewMode = getCookie("view-mode");
    if (viewMode == "desktop") {
        viewport.setAttribute('content', 'width=1024');
    } else if (viewMode == "mobile") {
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    }
});