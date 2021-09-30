$(document).ready(function()
{
    check();
    setInterval('check();', 300000)
});
function check()
{
    $.ajax({
        type:'POST',
        url:"mensajes/check.php",
        data: "process=check",
        dataType: 'json',
        success: function(datax)
        {
            if(datax.typeinfo == "Success")
            {
                send();
            }
            else
            {
            }
        }
    });
}
function send()
{
    $.ajax({
        type:'POST',
        url:"mensajes/send.php",
        data: "process=send",
        dataType: 'json',
        success: function(datax)
        {
            if(datax.typeinfo == "Success")
            {
                confirm();
            }
            else
            {
            }
        }
    });
}
function confirm()
{
    $.ajax({
        type:'POST',
        url:"mensajes/confirm.php",
        data: "process=confirm",
        dataType: 'json',
        success: function(datax)
        {
            if(datax.typeinfo == "Success")
            {
                console.log("Ok: Confirmed");
            }
            else
            {
            }
        }
    });
}
