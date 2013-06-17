$(document).ready(function() {

    var windowTitle;

    var aaData = [
            ['<input type="checkbox" />', 1, "CompareTradeCars", 'comparetradecars, Mattbluefoot, invent Partners, brooklandsmotors', '2013_05_20', '2013_06_15', 57, 'N/A', 'Ongoing'],
            ['<input type="checkbox" />', 2, "Time-Tracker", 'time-tracker, timekeeping, yeoman, grunt, bower', '2013_06_16', 'Currently Active', 3, 'N/A', 'New Project']
        ];

    var dataTableInfo = $('#current-projects').dataTable( {

        "aaData": aaData,
        "aoColumnDefs": [
            { "sClass": "project-name", "aTargets": [2] },
            { "sClass": "keywords", "aTargets": [3] }
        ]

    });

    getTitle(aaData, windowTitle);
});


function getTitle(aaData, windowTitle)
{
    $.get("./getTitleForAjax.php", function(data) {

        if (data !== windowTitle)
        {
            // Now we need to check if any of the programs have the 'data' var in their keywords
            $(aaData).each(function(data) {
                    // Grab the keywords
                    var keywords = $(this)[3];

                    var project = $(this)[2];

                    // If not then split them with commas and trim the reults
                     var keywords_array = keywords.split(',');

                    // Iterate through all to see if any have the data var
                    $.each(keywords_array, function(value, data) {
                        var value = keywords_array[value].trim().toLowerCase();

                        var data = data.trim().toLowerCase();

                        if (value == data) {
                            console.log('We have a match with the ' + value + ' keyword in the ' + project + ' project');

                            var project_id = $(this)[1];

                            // We now need to send an ajax request to start the timer for the
                            // project
                            var url = './updaterTimer.php';
                            var dataOut = {
                                action: 'start',
                                id:     project_id
                            };

                            $.ajax({
                                url:    url,
                                data:   data_out,
                                success:    function()
                                {
                                    console.log('Update Sucessfull');
                                }
                            });
                        }
                    });


                    // If they do then activate the activate-project function;
                        // Add the info to the DB
                        // Later on we can implement a file system storage for increaded user uptake
                        // Change the CSS of the project to reflect it
            });

        }
        windowTitle = data;

    });

    setTimeout(function(){getTitle(windowTitle)}, 5000);
}
