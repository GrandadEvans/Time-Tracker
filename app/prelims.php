<?php
/* File Itinerary
 * 1. Include db, email and firePHP classes
 * 2. Define CONSTANTS
 * 3. Define Variables and set empty arrays
 * 4. If not already set then set runtime variables
 * 5. If the required filed exist (they should) then require them, if they don't then throw an error
 * 6. verify server is localhost or remote and throw error if not
 * 7. Set "Content Type" header for this page/image etc
 * 8. Depending on file type carry out respective actions
*/

// Make sure that before we use the HTTP_HOST we sanitize it
define("HTTP_HOST", filter_var($_SERVER['HTTP_HOST'], FILTER_SANITIZE_STRING));

ini_set('display_errors', 'On');
// I use a sub-root folder for defence in-depth
define("DIR", "./");

/*   Configure the files we need to include   */
define("FILE_CONFIG",    DIR . "config.php");
define("FILE_FUNCTIONS", DIR . "functions.php");
define("FILE_DB",        DIR . "db.class.php");

/* define variables */
$clean = array();
$html = array();

// Make sure the files we NEED are available
		
	// The config file is essential
    require_once('config.php');

	// Include the file with all the required functions
	require_once(FILE_FUNCTIONS);

	// Ensure we are on an authorised server
	//verify_server();

	// Include db class 1st so that the functions file can reference it
	require_once(FILE_DB);

// Start the session
start_session();

// The set error handler must be called after the functions file has been
// included as the error_handler_php function resides in that file
set_error_handler('error_handler_php');
?>
