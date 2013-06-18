var newWindow;

$(document).ready(function() {

    var windowTitle;

    var dataTableInfo = $('#current-projects').dataTable( {

        "aoColumnDefs": [
            { "sClass": "project-name", "aTargets": [1] },
            { "sClass": "keywords", "aTargets": [2] }
        ]

    });

    getTitle(windowTitle);
});


function getTitle(windowTitle)
{
    $.get("./getTitleForAjax.php", function(data) {
               newWindow = data;

        if (data !== windowTitle)
        {
            // Now we need to check if any of the programs have the 'data' var in their keywords
            $($('.keywords')).each(function(data) {
                    // Grab the keywords
                    var keywords = $(this).text();

                    var project = $(this).parent().attr('data-project_id');

                    // If not then split them with commas and trim the reults
                     var keywords_array = keywords.split(',');

                    // Iterate through all to see if any have the data var
                    $.each(keywords_array, function(value, keyword, data) {
                        var keyword = keyword.trim().toLowerCase();


                        var searchResults = newWindow.toLowerCase().search(keyword);
                        if (searchResults > 0) {
                            console.log('We have a match with the ' + keyword + ' keyword in the ' + project + ' project');

                            //var project_id = $(this)[1];

                            //// We now need to send an ajax request to start the timer for the
                            //// project
                            //var url = './updaterTimer.php';
                            //var dataOut = {
                            //    action: 'start',
                            //    id:     project_id
                            //};

                            //$.ajax({
                            //    url:    url,
                            //    data:   data_out,
                            //    success:    function()
                            //    {
                            //        console.log('Update Sucessfull');
                            //    }
                            //});
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

    setTimeout(function(){getTitle(windowTitle)}, 15000);
}
