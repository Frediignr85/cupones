//obtener subtotal cantidad x precio
function subt(qty,price){
  subtotal=parseFloat(qty)*parseFloat(price);
  subtotal=round( subtotal,2);
  return subtotal;
}
//function to round 2 decimal places
function round(value, decimals) {
  return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

//function para scroll con perfect-scroll plugin
function scrolltable(){
  //scroll
  $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);
 /*
      $(window).on('resize', function(){
        ps.update();
      }) */
    });
  //end scroll
}
