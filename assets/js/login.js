$("#btn_recuperar_cuenta").click(function() {
    let email = $("#email").val();
    let msg = "";
    let error = false;
    if (email == "") {
        error = true;
        msg = "Hace Falta Introducir el Email!";
    }
    if (error) {
        swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
        });
    } else {
        if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)) {
            let base_url = $("#base_url").val();
            $.ajax({
                type: 'POST',
                url: base_url + "/recuperar/enviar",
                data: {
                    email: email,
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
                text: "El formato de email no es correcto!",
                icon: "error",
                button: "Ok!",
            });
        }
    }
});
$("#btn_cambiar_contra").click(function() {
    let password = $("#password").val();
    let repetir_password = $("#repetir_password").val();
    let id_cuenta_recuperar = $("#id_cuenta_recuperar").val();
    let msg = "";
    let error = false;
    if (password == "") {
        error = true;
        msg = "Hace Falta Introducir la Contraseña!";
    } else if (repetir_password == "") {
        error = true;
        msg = "Hace Falta Introducir la Confirmacion de la Contraseña!";
    }
    if (error) {
        swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
        });
    } else {
        if (password == repetir_password) {
            let base_url = $("#base_url").val();
            $.ajax({
                type: 'POST',
                url: base_url + "/recuperar/cambiar",
                data: {
                    password: password,
                    id_cuenta_recuperar: id_cuenta_recuperar,
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
                text: "Las Contraseñas no Coinciden!",
                icon: "error",
                button: "Ok!",
            });
        }
    }
});

const sign_in_btn = document.querySelector("#sign-in-btn-login");
const sign_up_btn = document.querySelector("#sign-up-btn-login");
const container = document.querySelector(".container-login");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});

$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $("#fecha_nacimiento").val("");
});

$("#btn_registrarse").click(function(event) {
    let nombre = $("#nombre").val();
    let direccion = $("#direccion").val();
    let telefono = $("#telefono").val();
    let dui = $("#dui").val();
    let fecha_nacimiento = $("#fecha_nacimiento").val();
    let email = $("#email1").val();
    let password = $("#password1").val();
    let repetir_password = $("#repetir_password").val();
    let msg = "";
    let error = false;
    if (nombre == "") {
        error = true;
        msg = "Hace Falta Introducir su Nombre!";
    } else if (direccion == "") {
        error = true;
        msg = "Hace Falta Introducir su Direccion!";
    } else if (telefono == "") {
        error = true;
        msg = "Hace Falta Introducir su Numero de Telefono!";
    } else if (dui == "") {
        error = true;
        msg = "Hace Falta Introducir su Numero de DUI!";
    } else if (fecha_nacimiento == "") {
        error = true;
        msg = "Hace Falta Introducir su Fecha de Nacimiento!";
    } else if (email == "") {
        error = true;
        msg = "Hace Falta Introducir su Email!";
    } else if (password == "") {
        error = true;
        msg = "Hace Falta Introducir su Password!";
    } else if (repetir_password == "") {
        error = true;
        msg = "Hace Falta Comprobar su Password!";
    }
    if (error) {
        swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
        });
    } else {
        if (password != repetir_password) {
            swal({
                title: "Error!",
                text: "Las contraseñas no coinciden!",
                icon: "error",
                button: "Ok!",
            });
        } else {
            if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)) {
                let base_url = $("#base_url").val();
                $.ajax({
                    type: 'POST',
                    url: base_url + "/login/registro",
                    data: {
                        nombre: nombre,
                        password: password,
                        telefono: telefono,
                        dui: dui,
                        fecha_nacimiento: fecha_nacimiento,
                        email: email,
                        direccion: direccion,
                    },
                    dataType: 'json',
                    async: false,
                    success: function(datax) {
                        if (datax.typeinfo == "Success") {
                            swal({
                                title: "Exito!",
                                text: "Cliente registrado con exito!",
                                icon: "success",
                                button: "Ok!",
                            });
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
                    text: "El formato de email no es correcto!",
                    icon: "error",
                    button: "Ok!",
                });
            }

        }
    }
});

$("#btn_login_ingresar").click(function() {
    let email = $("#email").val();
    let password = $("#password").val();
    let msg = "";
    let error = false;
    if (email == "") {
        error = true;
        msg = "Hace Falta Introducir el Email!";
    } else if (password == "") {
        error = true;
        msg = "Hace Falta Introducir el password!";
    }
    if (error) {
        swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
        });
    } else {
        if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)) {
            let base_url = $("#base_url").val();
            $.ajax({
                type: 'POST',
                url: base_url + "/login/login",
                data: {
                    password: password,
                    email: email,
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
                        setInterval("reload2();", 1500);
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
                text: "El formato de email no es correcto!",
                icon: "error",
                button: "Ok!",
            });
        }
    }
});





function reload1() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/login';
}

function reload2() {
    let base_url = $("#base_url").val();
    location.href = base_url + '/inicio';
}