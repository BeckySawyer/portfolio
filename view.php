<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && loggedIn()) {
    $content = $project_id = '';
    $project_id = $_POST['project_id'];

    if ($_POST["_method"] == "ADD") {
      $content = $_POST['content'];
            $id = $_POST['project_id'];
            addComment($dbh, $project_id, $content);
            addMessage('success', 'Comment successfully added');
            redirect('view.php?id=' . $project_id);
        }

        if ($_POST["_method"] == "delete") {
    $id = $_POST['id'];
    deleteComment($id, $dbh);
    addmessage('success', "You have successfully deleted a comment");
    redirect("view.php?id=" . $project_id);
  }
}

$singleProject = singleProject($_GET['id'], $dbh);
$comments = getComments($_GET['id'], $dbh);
// die (var_dump($comments));
require 'partials/header.php';
require 'partials/navigation.php';
?>
<div class="container">
 <?= showMessage() ?>
  <div class="row">
    <div class="col-md-12">
    </div>
  </div>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <img class="img-responsive" src="<?= $singleProject['img_url'] ?>">
      </div>
      <div class="panel-body">
        <h4><?= $singleProject['title'] ?></h4>
        <p><?= $singleProject['content'] ?></p>

      <div class="pull-right">
        <p><a href="<?= $singleProject['link'] ?>"> <?= $singleProject['link'] ?> </a></p>
      </div>
    </div>
  </div>
</div>

<!-- Start of Card -->
<div class="col-md-4">
  <div class="panel panel-default">
      <div class="panel-heading">
        <h5>More projects</h5>
      </div>
    <div class="panel-body">
      </div>
    </div>
</div>
<!-- End of Card -->
</div>

<div class="row">
  <div class="col-md-8">
    <!-- Fluid width widget -->
    <div id="comments" class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Recent Comments</h3>
    </div>
    <div class="panel-body">

<?php if(loggedIn()): ?>
        <ul class="media-list">
          <li class="media">
            <div class="media-left">
              <img class="comments-profile-photo" img src="<?= get_gravatar($email = $_SESSION['email'])?>">
            </div>
            <div class="media-body">
              <div class="form-group" style="padding:12px;">
                <form method="POST" action="view.php">

                  <input name="_method" type="hidden" value="ADD">
                  <input name="project_id" value="<?= $singleProject['id'] ?>" type="hidden">
                  <textarea name="content" class="form-control animated" placeholder="Leave a comment"></textarea>

                  <button class="btn btn-info pull-right" style="margin-top:10px" type="submit">Post</button>
                </form>
              </div>
            </div>
          </li>
        </ul>

        <hr>
<? endif; ?>

      
<?php
  if(!empty($comments)): 
            foreach ($comments as $comment):
                ?>
        <ul class="media-list">
          <li class="media">
            <div class="media-left">
                                <img class="comments-profile-photo" img src="<?= get_gravatar($email = $comment['email'])?>">
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?= $comment['username'] ?>                      
                <br>
                <div class="pull-right">
                  <small><?= formatTime(strtotime($comment['created_at'])) ?> </small> &nbsp;
<?php if(userOwns($comment['user_id'])): ?>
                  <form method="POST" action="view.php" style="display: inline-block;">

                        <input name="_method" type="hidden" value="delete">

                        <input name="id" type="hidden" value="<?= $comment['id']?>">
                        <input name="project_id" value="<?= $singleProject['id'] ?>" type="hidden" >
                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-default btn-xs btn-danger">
                          <i class="icon ion-ios-close-outline"></i> Delete
                        </button>

                      </form>
                    <? endif; ?>
                </div>
              </h4>
              <p><?= $comment['content'] ?> </p>
            </div>
          </li>
        </ul>
<?php
endforeach;
else:
?>

<ul class="media-list">
              <li class="media">
                <div class="media-body">
                  <p>
                    No Comments
                  </p>
                </div>
              </li>
            </ul>

            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
    require 'partials/footer.php';
?>