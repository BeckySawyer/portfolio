<?php
    require 'partials/header.php';
    require 'partials/navigation.php';
 ?>

        <!-- Start of Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Instructions</div>
                        <div class="panel-body">
                        <ul>
                            <li>
                                Setup file structure for project (Includes, Partials, Function files)
                            </li>
                            <li>
                                Use draw.io to design a database based on the input field on dashboard.php page.
                            </li>
                            <li>
                                Once database is designed, ask for it to be reviewed by Ash or Danny.
                            </li>
                            <li>
                                When approved you will set the database up in PhpMyAdmin or Sequel Pro.
                            </li>
                            <li>
                                Add some dummy data for projects to be used for display.
                            </li>
                            <li>
                                Then create a config.php file and connect the database up.
                            </li>
                            <li>
                                Create a foreach loop for the index page and loop over all projects in the database.
                            </li>
                            <li>
                                Once done, wait for more instructions or add some fancy features of your own.
                            </li>


                        </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content -->
<?php
require 'partials/footer.php';
?>