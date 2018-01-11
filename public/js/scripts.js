$(document).ready(function($){
    $.noConflict();
    $('#completed').DataTable({
        responsive: true
    });
    $('#myTable').DataTable({
        responsive: true
    });
    $('#notCompleted').DataTable({
        responsive: true
    });
});