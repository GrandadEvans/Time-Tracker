<?php
    require_once('prelims.php');
    require_once('getProgram.class.php');?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>A Test Title</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="styles/main.css">
        <!-- build:js scripts/vendor/modernizr.js -->
        <script src="bower_components/modernizr/modernizr.js"></script>
        <!-- endbuild -->
        <link rel="stylesheet" href="components/DataTables/media/css/jquery.dataTables.css" />
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Time-Tracker</h1>
            </div>

            <div class="synopsys">
                <p>This app will track the time you spend actively working on windows with keywords
                that you specify on a per project basis.</p>

                <h2>Options</h2>
                <span class="shared-width"><a class="btn btn-info">Add a new Project</a></span>
                <span class="shared-width"><a class="btn btn-info">View Usage</a></span>


                <p>Window information: You have been on this window (<span style="color:darkRed"
                    id="current-project"><?php
                    $window = new getProgram;
                    $windowTitle = $window->worker(); echo $windowTitle;?></span>) for un unspefied amount of time.<small>Why
                        unspecified?</small></p>
            </div>

            <div class="current-projects">
                <h2>Current Projects</h2>

                <table id="current-projects">
                    <thead>
                        <th><input type="checkbox" /></th>

                        <th>Project Name</th>
                        <th>Keywords</th>
                        <!--<th>Start Date</th>-->
                        <th>Last Active</th>
                        <th>Actions</th>
                        <th>Remarks</th>
                    </thead>

                    <tbody>
                    <?php
                        require_once('./models/default.class.php');
                        $obj = new defaultDB;
                        $results = $obj->getDefaultListings();
                        foreach($results as $key => $value)
                            {
                            ?>
                            <tr data-project_id="<?php echo $value[0];?>" id="project_<?php echo
                                $value[0];?>">
                                <td><input type="checkbox" id="project_<?php echo $value[0];?>_checkbox" /></td>
                                <td><?php echo $value[1];?></td>
                                <td><?php echo $value[2];?></td>
                                <!--<td><?php echo $value[3];?></td> -->
                                <td><?php echo $value[4];?></td>
                                <td id="project_<?php echo $value[0];?>_icons">
                                    <i class="icon-remove icon-black"></i>
                                    <i class="icon-download icon-black"></i>
                                </td>
                                <td><?php echo $value[6];?></td>
                            </tr>
                            <?php }?>
                    </tbody>

                </table>
            </div>


        </div>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

        <!-- build:js scripts/main.js -->
        <script src="bower_components/jquery/jquery.js"></script>
        <script src="scripts/main.js"></script>
        <!-- endbuild -->

        <!-- build:js(.tmp) scripts/coffee.js -->
        <script src="scripts/hello.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/plugins.js -->
        <script src="bower_components/sass-bootstrap/js/bootstrap-affix.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-alert.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-dropdown.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-tooltip.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-modal.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-transition.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-button.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-popover.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-typeahead.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-carousel.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-scrollspy.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-collapse.js"></script>
        <script src="bower_components/sass-bootstrap/js/bootstrap-tab.js"></script>
        <!-- endbuild -->

        <script src="components/DataTables/media/js/jquery.dataTables.js"></script>
</body>
</html>
