<?php
require 'includes/config.php';
$singleProject = singleProject($_GET['id'], $dbh);
require 'partials/header.php';
require 'partials/navigation.php';
?>
<div class="container">
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
        <ul class="media-list">
          <li class="media">
            <div class="media-left">
              <img class="comments-profile-photo" src="https://www.gravatar.com/avatar/722386073723549e170eccc06a566818?s=80&d=mm&r=g">
            </div>
            <div class="media-body">
              <div class="form-group" style="padding:12px;">
                <form method="POST" action="view.php?id=6">

                  <input name="_method" type="hidden" value="ADD">

                  <textarea name="content" class="form-control animated" placeholder="Leave a comment"></textarea>

                  <button class="btn btn-info pull-right" style="margin-top:10px" type="submit">Post</button>
                </form>
              </div>
            </div>
          </li>
        </ul>
        <hr>

        <ul class="media-list">
          <li class="media">
            <div class="media-left">
             <img src="https://www.gravatar.com/avatar/1e0fd3e785708a7ae747de2972159ce1?s=80&d=mm&r=g" class="comments-profile-photo">
            </div>
            <div class="media-body">
              <h4 class="media-heading">ashleybakernz                      
                <br>
                <div class="pull-right">
                  <small>14 hours ago</small>&nbsp;
                </div>
              </h4>
              <p>This is laaammeee.</p>
            </div>
          </li>
        </ul>

        <ul class="media-list">
          <li class="media">
            <div class="media-left">
              <img src="https://www.gravatar.com/avatar/a817d8d52e5dc2cb5305c198e3a9de7d?s=80&d=mm&r=g" class="comments-profile-photo">
            </div>
            <div class="media-body">
              <h4 class="media-heading">Danny<br>
                <div class="pull-right">
                  <small>14 hours ago</small>&nbsp;
                </div>
              </h4>
              <p>This is a comment.</p>
            </div>
          </li>
        </ul>

        </div>
      </div>
    </div>
  </div>
</div>

<?php 
    require 'partials/footer.php';
?>