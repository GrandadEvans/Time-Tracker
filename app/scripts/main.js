// Set the global variables
var newWindow;
var active;

// How many seconds should the system allow between searches?
var searchSeconds = 15;

$(document).ready(function() {

    var windowTitle;

    var dataTableInfo = $('#current-projects').dataTable( {
        "aoColumnDefs": [
            { "sClass": "project-name", "aTargets": [1] },
            { "sClass": "keywords", "aTargets": [2] }
        ]

    });

    //start the infinite loop off
    getTitle(windowTitle);

});


function getTitle(windowTitle)
{
    // Get the window title
    $.get("./getTitleForAjax.php", function(data) {

        // If the windowTitle does not match the newly created window titlle then remove all active
        // classes and set the active var to false as standard
        if (newWindow !== data) {
            active = false;
            removeActiveProjects();
        }

            // Set the window title to the global variable
        newWindow = data;

        // Set the display feedback
        $('#current-project').text(newWindow);

        // Now we need to check if any of the programs have the window title var in their keywords
        // Iterate through all the tds with a class of keywords
        $($('.keywords')).each(function(data) {

            // Grab the keywords
            var keywords = $(this).text();

            // Set the parent (the row) and get the project id
            project_tr = $(this).parent();
            var project = project_tr.attr('data-project_id');

            // Split them with commas and trim the results
            var keywords_array = keywords.split(',');

            // Iterate through all to see if any have the window title
            $.each(keywords_array, function(value, keyword, data) {

                // We will also be tranforming both the window title and the keyword to lowercase to
                // aid in searching
                var keyword = keyword.trim().toLowerCase();

                // Perform the actual search on the keyword
                var searchResults = newWindow.toLowerCase().search(keyword);

                // If negative the result will be -1 and if not it will be the position of the
                // first keyword so we need to check for position 0 upwards
                if (searchResults >= 0) {

                    // Set the active var so that we know one of the searches has been successful
                    active = true;

                    // Before we continue remove the current active classes
                    removeActiveProjects();

                    // We now need to send an ajax request to start the timer for the
                    // project
                    var url = '../updateTimer.php';
                    var dataOut = {
                        action: 'start',
                        project_id:     project,
                        keyword:        keyword
                    };

                    $.ajax({
                        url:    url,
                        data:   dataOut,
                        success:    function(result)
                        {
                            // If the request was successfull
                            if (result.trim() == 'ok') {

                                // Find the project row
                                var project_tr = $('#project_' + project);

                                // Add the active class
                                project_tr.addClass('active');

                                // Add an active icon to the project
                                $('#project_' + project + '_icons').append('<img class="active_icon" src="images/active.png" alt="active" height="14" width="14" />');

                                $('#favicon').attr('href', 'images/green_favicon.ico');
                            }

                        } // end of ajax success

                    }); // End of ajax call

                } // End of if search successfull

            }); // End of itteration through the keyword arrays

        }); // End of iteration though keyword classes

    }); // End of getWindowTitle function

    // If none of the searches has been successfull
    if (active !== true)
    {
        // Make sure that active is not set
        active = false;

        // Send an ajax call to make sure all timers are stopped
        var url = '../updateTimer.php';
        var dataOut = {
            action: 'stop'
        };

        $.ajax({
            url:    url,
            data:   dataOut,
            success:    function(result) {
                if (result.trim() == 'ok') {
                    //console.dir(result);
                }
            }
        });

        // Remove any active projects
        removeActiveProjects();

    } // End of if all searches failed


    //windowTitle = data;

    // Keep the infinite loop going after the required time
    setTimeout(function(){getTitle(windowTitle)}, searchSeconds * 1000);


function removeActiveProjects()
{
    $('.active').each(function() {
        $(this).removeClass('active');
    });

    $('.active_icon').each(function() {
        $(this).css('border', '2px solid red');
        $(this).remove();
    });

    $('#favicon').attr('href', 'favicon.ico');

}
} // End of getTitle function
