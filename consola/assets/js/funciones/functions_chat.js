const msg_card_body = document.getElementById('.msg_card_body');

$(document).on('click', '.floating-btn', function(event) {
    $("#openModal").css({
        'opacity': '1',
        'pointer-events': 'auto'
    });
});

$(document).on('click', '.floating-btn', function(event) {
    $("#openModal").css({
        'opacity': '1',
        'pointer-events': 'auto'
    });
});
$(document).on('click', '#cerrar', function(event) {
    $("#openModal").css({
        'position': 'fixed',
        'font-family': 'Arial, Helvetica, sans-serif',

        'right': '0',
        'bottom': '0',
        'left': '0',
        'z-index': '99999',
        'opacity': '0',
        '-webkit-transition': 'opacity 400ms ease-in',
        '-moz-transition': 'opacity 400ms ease-in',
        'transition': 'opacity 400ms ease-in',
        'pointer-events': 'none'
    });
});


$(document).on('click', '#floating-btn', function(event) {
    console.log("entro");
    setTimeout(function() {
        traer();
    }, 100)
});

function traer() {
    /*Esto valida si el chat esta abierto o cerrado al abrir la pagina*/
    var em = document.getElementById("openModal");
    var temp = window.getComputedStyle(em).getPropertyValue("opacity");

    if (temp == 0) {
        console.log("cerrado");
    } else {
        /*ir a traer todos los miembros del chat y ponerlos a un lado junto con los mensajes sin leer de cada uno*/
        console.log("abierto");

        $.ajax({
            url: 'chat.php',
            type: 'POST',
            dataType: 'json',
            data: { process: 'miembros' },
            success: function(xdatos) {

                var iphp = xdatos.i;
                var add = "";

                for (var i = 0; i < iphp; i++) {

                    add += "<li class='' id_c='" + xdatos.id[i] + "'>";
                    add += "<div class='d-flex bd-highlight'>";
                    add += "<div class='img_cont'>";

                    if (xdatos.tiene[i] == 1) {
                        add += "<img src='" + xdatos.imagen[i] + "' class='rounded-circle user_img'>";
                    } else {
                        add += "<div class='user_img rounded-circle padre'>" + xdatos.imagen[i] + "</div>";
                    }

                    if (xdatos.activo[i] == 1) {
                        add += "<span class='online_icon '></span>";
                    } else {
                        add += "<span class='online_icon offline'></span>";
                    }

                    if (xdatos.mensaje[i] > 0) {
                        add += "<span class='icon_messages'>" + xdatos.mensaje[i] + "</span>";
                    } else {
                        add += "<span class='icon_messages'></span>";
                    }

                    add += "</div>";
                    add += "<div class='user_info'>";
                    add += "<span class='chat_name' >" + xdatos.nombre[i] + "</span>";
                    add += "<p>" + xdatos.fecha[i] + "</p>";
                    add += "</div>";
                    add += "</div>";
                    add += "</li>";

                }
                $('#contactos_chat').html(add);
            }
        });

    }
}
$(document).on('click', 'ui li', function(event) {
    $("ui li").removeClass('active');
    $(this).addClass('active');
    $("#actual").html($(this).find('.img_cont').html());
    $('#actual_chat_name').html($(this).find('.chat_name').html());
    $('.msg_card_body').html('');

    $('#id_chat').val($(this).attr('id_c'));

    traer_datos_chat($(this).attr('id_c'));
});

function traer_datos_chat(id_chat) {
    id_cha = id_chat;
    $.ajax({
        url: 'chat.php',
        type: 'POST',
        dataType: 'json',
        data: { process: 'chat_mensajes', id_chat: id_chat },
        success: function(xdatos) {

            var iphp = xdatos.i;
            console.log(xdatos.i);
            var add = "";

            var data = "";

            for (var i = 0; i < iphp; i++) {
                if (xdatos.enviado[i] == 0) {
                    add += "<div class='d-flex justify-content-start mb-4'>";
                    add += "<div class='img_cont_msg'>";
                    if (xdatos.tiene_d == 1) {
                        add += "<img src='" + xdatos.imagen_d + "' class='rounded-circle user_img_msg'>";
                    } else {
                        add += "<div class='user_img_msg rounded-circle padre'>" + xdatos.imagen_d + "</div>";
                    }
                    add += "</div>";
                    add += "<div class='msg_cotainer'>";
                    add += xdatos.mensaje[i];
                    add += "<span class='msg_time'>" + xdatos.hora[i] + ", " + xdatos.fecha[i] + "</span>";
                    add += "</div>";
                    add += "</div>";

                    data = add + data;
                    add = "";
                } else {
                    add += "<div class='d-flex justify-content-end mb-4'>";
                    add += "<div class='msg_cotainer_send'>";
                    add += xdatos.mensaje[i];
                    add += "<span class='msg_time_send'>" + xdatos.hora[i] + ", " + xdatos.fecha[i] + "</span>";
                    add += "</div>";
                    add += "<div class='img_cont_msg'>";
                    if (xdatos.tiene_o == 1) {
                        add += "<img src='" + xdatos.imagen_o + "' class='rounded-circle user_img_msg'>";
                    } else {
                        add += "<div class='user_img_msg rounded-circle padre'>" + xdatos.imagen_o + "</div>";
                    }

                    add += "</div>";
                    add += "</div>";

                    data = add + data;
                    add = "";
                }
            }

            $('.msg_card_body').html(data);
            setTimeout(100);
            var div = $(".msg_card_body");
            div.scrollTop(div.prop('scrollHeight'));
        }
    })
}

$(document).on('click', '.send_btn', function(event) {
    var id_chat = parseInt($('#id_chat').val());
    var mensaje = $('.type_msg').val();

    console.log(id_chat);
    if (id_chat == 0) {

        display_notify("Error", "Seleccione al menos un chat para iniciar el chat");

    } else {

        if (mensaje != '') {
            $.ajax({
                url: 'chat.php',
                type: 'POST',
                dataType: 'json',
                data: { process: 'addmensaje', id_chat: id_chat, mensaje: mensaje },
                success: function(xdatos) {
                    $('.type_msg').val("");
                    traer_datos_chat(id_chat);

                }
            });
        } else {
            display_notify("Error", "No puede enviar mensajes vacios");
        }
    }
});


$(document).on("keydown", ".type_msg", function(evt) {
    evt.preventDefault();

    if (evt.keyCode != 13) {} else {
        var id_chat = parseInt($('#id_chat').val());
        var mensaje = $('.type_msg').val();

        console.log(id_chat);
        if (id_chat == 0) {

            display_notify("Error", "Seleccione al menos un chat para iniciar el chat");

        } else {

            if (mensaje != '') {
                $.ajax({
                    url: 'chat.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { process: 'addmensaje', id_chat: id_chat, mensaje: mensaje },
                    success: function(xdatos) {
                        $('.type_msg').val("");
                        traer_datos_chat(id_chat);

                    }
                });
            } else {
                display_notify("Error", "No puede enviar mensajes vacios");
            }
        }
    }
});