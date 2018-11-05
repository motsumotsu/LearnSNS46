<?php
    session_start();
    require('function.php');
    require('dbconnect.php');
    //v($_SESSION["id"],'_SESSION["id"]');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION['id']);

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);
    v($signin_user,'signin_user');

    $validation=[];

    if(!empty($_POST)){

      $feed = $_POST['feed'];
      if ($feed == '') {
        $validation['feed'] = 'blank';
      }else{
        $sql = 'INSERT INTO `feeds` SET `user_id`=?, `feed`=?,`created`=NOW()';
        $stmt = $dbh->prepare($sql);
        $data = array($signin_user['id'],$feed);
        $stmt->execute($data);
      }
    }





?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
    <style>
      .error_msg{
        color: red;
        font-size: 12px;
      }
    </style>

  
</head>
<body>
  ユーザー情報[<img width="30" src="user_profile_img/<?php echo $signin_user['img_name']; ?>" />]
  <?php echo $signin_user["name"]; ?>]

  [<a href="signout.php">サインアウト</a>]
  <form method="POST" action="">
    <textarea rows="5" name="feed"></textarea>
    <input type="submit" value="投稿">
    <?php if (isset($validation['feed']) && $validation['feed'] == 'blank'): ?>
    <br>
    <span class="error_msg">投稿データを入力してください。</span>
      <?php endif; ?>
  </form>
</body>
</html>