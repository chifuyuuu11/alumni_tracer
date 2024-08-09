$(document).ready(function() {
    $('#attained').on('change', function() {
        var attained_id = $(this).val();
        var collegeIds = [16, 17, 18, 19, 20];

        if (collegeIds.includes(parseInt(attained_id))) {
            $('#program').prop('disabled', false);
        } else {
            $('#program').prop('disabled', true);
        }
    });

    $('#batch').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years',
        autoclose: true
    });

    $('#batch').inputmask('9999');

});
