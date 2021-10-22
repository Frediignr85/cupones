$(document).ready(function() {
    let base_url = $("#base_url").val();
    $('#formulario_login').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Por favor ingrese el nombre de usuario!",
            },
            password: {
                required: "Por favor ingrese el password!",
            },
        },
        submitHandler: function(form) {
            senddata();
        }
    });

    $('#formulario_recuperar').validate({
        rules: {
            username: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Por favor ingrese el nombre de usuario!",
            },
        },
        submitHandler: function(form) {
            senddata2();
        }
    });
    $('#recuperar_contra').validate({
        rules: {
            password: {
                required: true,
            },
            repetir_password: {
                required: true,
            },
        },
        messages: {
            password: {
                required: "Por favor introduzca su Contraseña.",
            },
            repetir_password: {
                required: "Repita su Contraseña por favor.",
            },
        },
        submitHandler: function(form) {
            senddata3();
        }
    });
});



function senddata() {
    let base_url = $("#base_url").val();
    var username = $('#username').val();
    var password = $('#password').val();
    $.ajax({
        type: 'POST',
        url: base_url + "/login/login",
        data: { username: username, password: password },
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload1();", 1500);
            }
        }
    });
}

function senddata2() {
    let base_url = $("#base_url").val();
    var username = $('#username').val();
    $.ajax({
        type: 'POST',
        url: base_url + "/recuperar/enviar",
        data: { username: username },
        dataType: 'json',
        success: function(datax) {
            display_notify(datax.typeinfo, datax.msg);
            if (datax.typeinfo == "Success") {
                setInterval("reload1();", 1500);
            }
        }
    });
}

function senddata3() {
    let base_url = $("#base_url").val();
    var password = $('#password').val();
    var repetir_password = $("#repetir_password").val();
    let id_cuenta_recuperar = $("#id_cuenta_recuperar").val();
    if (password == "" || repetir_password == "") {
        display_notify("Error", "Tiene que completar todos los campos");
    } else {
        if (password != repetir_password) {
            display_notify("Error", "Los Password no coinciden");
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + "/recuperar/cambiar",
                data: { password: password, id_cuenta_recuperar: id_cuenta_recuperar },
                dataType: 'json',
                success: function(datax) {
                    display_notify(datax.typeinfo, datax.msg);
                    if (datax.typeinfo == "Success") {
                        setInterval("reload1();", 1500);
                    }
                }
            });
        }
    }

}



function reload1() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/dashboard';
}