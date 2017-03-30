<?php
    require 'includes/config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["_method"] == "delete") {
            $id = $_POST['id'];
            deleteProject($id, $dbh);
            redirect('index.php');
        }

        if ($_POST["_method"] == "edit") {
            $id = $_POST['editid'];
            // editProject($id, $dbh);
            redirect('edit.php?id=' . $id);
        }
    }
    require 'partials/header.php';
    require 'partials/navigation.php';
 ?>

        <!-- Start of Content -->
        <div class="container">
            <div class="row">
            <!-- Your loop will start here and loop through the card markup -->
            <?php
            foreach ($projects as $project):
                ?>
                <!-- Start of Card -->
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading card-header">
                        <img class="img-responsive" src="<?= $project['img_url'] ?>">
                        </div>

                        <div class="panel-body">
                            <h4><?= substr($project['title'], 0 , 20) ?></h4>
                            <p>
                                <?= substr($project['content'], 0, 100) ?>
                            </p>
                            <a href="<?= $project['link'] ?>" class="btn btn-default btn-xs">
                                View
                            </a>

                            <form method="POST" action="index.php">
                            <input name="_method" value="delete" type="hidden">
                            <input name="id" value="<?= $project['id'] ?>" type="hidden">

                            <button class="btn btn-default btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" type="submit"> Delete </button>
                            </form>

                            <form method="POST" action="index.php">
                            <input name="_method" value="edit" type="hidden">
                            <input name="editid" value="<?= $project['id'] ?>" type="hidden">

                            <button class="btn btn-default btn-xs" type="submit"> Edit </button>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End of Card -->
<?php
endforeach
?>

            </div>
            </div>
 <?php
require 'partials/footer.php';
?>