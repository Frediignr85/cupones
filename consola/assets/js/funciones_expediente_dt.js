$(document).ready(function() {    
   	buscar();
	$("#buscar").click(function(){
		buscar();
	});
});
$(function ()
{
	//binding event click for button in modal form
	$(document).on("click", "#btnDelete", function(event)
	{
		deleted();
	});
	// Clean the modal form
	$(document).on('hidden.bs.modal', function(e)
	{
		var target = $(e.target);
		target.removeData('bs.modal').find(".modal-content").html('');
	});
	
});
function buscar()
{
	var ini = $("#desde").val();
    var fin = $("#hasta").val();
    var id_paciente = $("#id_paciente").val();
    var dataString="ini="+ini+"&fin="+fin+"&id="+id_paciente;
    $.ajax({
		type : "POST",
		url : "expediente_dt.php",
		data : dataString,
		success : function(datax) {
			$("#refill").html(datax);
		}
	});
}
function deleted()
{
	var id_cita = $('#id_cita').val();
	var dataString = 'process=deleted' + '&id=' + id_cita;
	$.ajax({
		type : "POST",
		url : "borrar_consulta.php",
		data : dataString,
		dataType : 'json',
		success : function(datax)
		{
			display_notify(datax.typeinfo, datax.msg);
			if(datax.typeinfo=="Success")
			{
				$('#deleteModal').hide(); 
				setInterval("location.reload();", 1000);
			}
		}
	});
}