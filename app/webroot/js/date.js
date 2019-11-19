$(function() {
    // datepicker
    $("#due_date, #due_date_from, #due_date_to").datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#dateClear').on('click', function() {
        $('#due_date').val('');
    });
    $('#dateClearFrom').on('click', function() {
        $('#due_date_from').val('');
    });
    $('#dateClearTo').on('click', function() {
        $('#due_date_to').val('');
    });
});