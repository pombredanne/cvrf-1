/**
 * Created by rafix on 6/09/14.
 */

$(function() {
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange: "1910:2020",
        changeMonth: true
    });
});