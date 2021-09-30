$(document).ready(function() {
    $(".select").select2();
    $("#logo").fileinput({ 'showUpload': true, 'previewFileType': 'image' });
    $(".numeric").numeric({ negative: false });
    $('#formulario_empresa').validate({
        rules: {
            nombre: {
                required: true,
            },
            propietario: {
                required: true,
            },
            telefono1: {
                required: true,
            },
            departamento: {
                required: true,
            },
            municipio: {
                required: true,
            },
            direccion: {
                required: true,
            },
            moneda: {
                required: true,
            },
            simbolo: {
                required: true,
            },
            tipo: {
                required: true,
            },
        },
        messages: {
            nombre: "Por favor ingrese el nombre del empresa",
            propietario: "Por favor ingrese el propietario del empresa",
            telefono1: "Por favor ingrese el número de teléfono",
            departamento: "Por favor seleccione un departamento",
            municipio: "Por favor seleccione un municipio",
            direccion: "Por favor ingrese la dirección del empresa",
            moneda: "Por favor ingrese el nombre de la moneda",
            simbolo: "Por favor ingrese el simbolo de la moneda",
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form) {
            senddata();
        }
    });
    $("#departamento").change(function() {
        $("#municipio *").remove();
        $("#select2-municipio-container").text("");
        var ajaxdata = { "process": "municipio", "id_departamento": $("#departamento").val() };
        $.ajax({
            url: "agregar_paciente.php",
            type: "POST",
            data: ajaxdata,
            success: function(opciones) {
                $("#select2-municipio-container").text("Seleccione");
                $("#municipio").html(opciones);
                $("#municipio").val("");
            }
        })
    });
    $('#nit').on('keydown', function(event) {
        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

        } else {
            inputval = $(this).val();
            var string = inputval.replace(/[^0-9]/g, "");
            var bloque1 = string.substring(0, 4);
            var bloque2 = string.substring(4, 10);
            var bloque3 = string.substring(10, 13);
            var blocque = string.substring(13, 13);
            var string = (bloque1 + "-" + bloque2 + "-" + bloque3 + "-" + blocque);
            $(this).val(string);
        }
    });
    $('.tel').on('keydown', function(event) {
        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) {

        } else {
            inputval = $(this).val();
            var string = inputval.replace(/[^0-9]/g, "");
            var bloc1 = string.substring(0, 4);
            var bloc2 = string.substring(4, 7);
            var string = bloc1 + "-" + bloc2;
            $(this).val(string);
        }
    });
});
$(function() {
    //binding event click for button in modal form
    $(document).on("click", "#btnDelete", function(event) {
        deleted();
    });
    // Clean the modal form
    $(document).on('hidden.bs.modal', function(e) {
        var target = $(e.target);
        target.removeData('bs.modal').find(".modal-content").html('');
    });
});

function autosave(val) {
    var name = $('#name').val();
    if (name == '' || name.length == 0) {
        var typeinfo = "Info";
        var msg = "The field name is required";
        display_notify(typeinfo, msg);
        $('#name').focus();
    } else {
        senddata();
    }
}

function senddata() {
    var form = $("#formulario_empresa");
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }
    var formAction = form.attr('action');
    $.ajax({
        type: 'POST',
        url: 'admin_empresa.php',
        cache: false,
        data: formdata ? formdata : form.serialize(),
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            display_notify(data.typeinfo, data.msg, data.process);
            if (data.typeinfo == "Success") {
                setInterval("reload1();", 1500);
            }
        }
    });
}

function reload1() {
    location.href = 'admin_empresa.php';
}