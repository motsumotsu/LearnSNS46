<?php
    session_start();
    require('../function.php');
    //DB接続処理定型文↓
    require('../dbconnect.php');


    //$_SESSIONの中に46_LearnSNSが定義されていなければ強制的にsignup.phpに飛ばす
    if (!isset($_SESSION['46_LearnSNS'])) {
      header('Location: signup.php');
    }
    v($_POST,'$_POST');

    $name = $_SESSION['46_LearnSNS']['name'];
    $email = $_SESSION['46_LearnSNS']['email'];
    $password = $_SESSION['46_LearnSNS']['password'];
    $file_name = $_SESSION['46_LearnSNS']['file_name'];


    //POST送信されたら
    if (!empty($_POST)) {
      //パスワードのハッシュ化↓
      $hash_password = password_hash($password, PASSWORD_DEFAULT);
      //DB登録処理↓
      $sql = 'INSERT INTO `users` SET `name`=?,`email`=?,`password`=?,`img_name`=?,`created`=NOW()';
      //DB上cleatedの欄に日付が表示されるようにするための、NOW関数→ｓｑｌ側の関数（PHPの関数ではない）
    //↓sqlのカラム名の値は毎回変わるので？を入れる
    $stmt = $dbh->prepare($sql);
    $data = array($name,$email,$hash_password,$file_name);
    $stmt->execute($data);
    
    unset($_SESSION['46_learnsns']);
    header('Location: thanks.php');
    exit();//処理を終了させる
    }

    

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
</head>
<body>
  <div>
    ユーザー名：<?= h($name); ?>
  </div>
  <div>
    メールアドレス：<?= h($email); ?>
  </div>

  <div>
    パスワード：●●●●
  </div>
  <div>
    <img src="../user_profile_img/<?= h($file_name); ?>" width="100">
  </div>
  <form method="POST" action="">
    <input type="hidden" name="hoge" value="fuga">
    <input type="submit" value="アカウント作成">
  </form>

</body>
</html>