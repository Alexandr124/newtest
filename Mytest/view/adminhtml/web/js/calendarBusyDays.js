define(['jquery',"mage/calendar"], function ($) {
    return function (config) {
        var disableddates = config.dates.split(',');
        function DisableSpecificDates(date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [disableddates.indexOf(string) === -1];
        }
        $('#example-date').calendar({
                                        beforeShowDay: DisableSpecificDates,
                                        changeMonth: true,
                                        changeYear: true,
                                        showButtonPanel: true,
                                        showsTime: true
                                    });
    }
});