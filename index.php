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

        if ($_POST["_method"] == "view") {
            $id=$_POST['viewid'];
            // editProject($id, $dbh);
            redirect('view.php?id=' . $id);
        }
    }
    require 'partials/header.php';
    require 'partials/navigation.php';
 ?>

        <!-- Start of Content -->
        <div class="container">
            <div class="row">
            <?= showMessage() ?>
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

                            <form method="POST" action="index.php" style="display: inline-block;">
                                <input name="_method" value="view" type="hidden">
                                <input name="viewid" value="<?= $project['id'] ?>" type="hidden">
                                <button class="btn btn-default btn-xs" type="submit"> <i class="icon ion-eye"></i> View </button>
                            </form>
                            
                            <div class="pull-right">
                            <form action="index.php" method="POST" style="display: inline-block;">
                                <input name="_method" value="delete" type="hidden">
                                <input name="id" value="<?= $project['id'] ?>" type="hidden">
                                <button class="btn btn-danger btn-xs" onclick="return confirm('are you sure you want to delete this item');" type="submit"><i class="icon ion-ios-close-outline"></i> Delete</button>
                            </form>

                            <form method="POST" action="index.php" style="display: inline-block;">
                                <input name="_method" value="edit" type="hidden">
                                <input name="editid" value="<?= $project['id'] ?>" type="hidden">
                                <button class="btn btn-info btn-xs" type="submit"> <i class="icon ion-edit"></i> Edit</button>
                            </form>

                        </div>
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