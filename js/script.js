
$( document ).ready(function() {
    $('.btn-add-client').on("click", function() {
        $('#modal-add-client').modal('show')
    });
    
    $('#notification').toast('show')
});