let base_url = "";
$(document).ready(function() {
    base_url = $("#base_url").val();
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
});



function senddata() {
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

function reload1() {
    location.href = base_url + '/dashboard';
}