$(function() {
    $(document).on('hidden.bs.modal', function(e) {
        var target = $(e.target);
        target.removeData('bs.modal').find(".modal-content").html('');
    });


});
$(document).ready(function() {
    var viewMode = getCookie("view-mode");
    if (viewMode == "desktop") {
        viewport.setAttribute('content', 'width=1024');
    } else if (viewMode == "mobile") {
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    }
});