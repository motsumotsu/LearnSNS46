  <div class="thumbnail">

            <div class="row">
              <div class="col-xs-1">
                <img src="user_profile_img/<?php echo $feed_each["profile_img"]; ?>" width="40">
              </div>
              <div class="col-xs-11">
                <?php echo $feed_each["name"]; ?><br>
                <a href="#" style="color: #7F7F7F;"><?php echo $feed_each["created"]; ?></a>
              </div>
            </div>
            <div class="row feed_content">
              <div class="col-xs-12" >
                <span style="font-size: 24px;"><?php echo $feed_each["feed"]; ?></span>
              </div>
            </div>
            <div class="row feed_sub">
              <div class="col-xs-12">
                 <span hidden class="feed-id"><?= $feed_each["id"] ?></span>
                 <?php if($feed_each['is_liked']): ?>
                  <button class="btn btn-default btn-xs js-unlike">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    <span>いいねを取り消す</span>
                    </button>
                 <?php else:?>
                  <button class="btn btn-default btn-xs js-like">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    <span>いいね!</span>
                    </button>
                    <?php endif;?>
                    <span>いいね数 : </span>
                    <span class="like_count"><?php echo $feed_each['like_count'] ?></span>
                  
                <span class="comment_count">コメント数 : 9</span>
                <?php if ($_SESSION['id'] == $feed_each["user_id"]) : ?>
                  <a href="edit.php?feed_id=<?php echo $feed_each['id']; ?>" class="btn btn-success btn-xs">編集</a>
                  <a onclick="return confirm('本当に消すの？');" href="delete.php?feed_id=<?php echo $feed_each['id']; ?>"class="btn btn-danger btn-xs">削除</a>
                  <?php endif; ?>
              </div>
            </div>
          </div>