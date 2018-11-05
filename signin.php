<?php
    session_start();
    require('function.php');
    require('dbconnect.php');

    v($_POST,'$_POST');

    $validation = [];
    
    //POST送信されたら
    if (!empty($_POST)) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      //空バリ
      if ($email != '' && $password != ''){
          //空じゃなければ、データベースに問い合わせ↓
          $sql ='SELECT * FROM `users` WHERE`email`=?';
          $stml = $dbh->prepare($sql);
          $data = [$email];
          $stml->execute($data);
          //
          $record = $stml->fetch(PDO::FETCH_ASSOC);
          v($record,'$record');

          if ($record == false) {
              $validation['signin'] = 'failed';
          }

          //パスワードの照合
          $verify = password_verify($password,$record['password']);
          if ($verify == true) {
            //サインイン成功
            $_SESSION["id"] = $record["id"];//データは一つのみ
            header('Location: timeline.php');
            exit();
          }else{
            //パスワードミス↓
            $validation['signin'] = 'failed';
          }

      }else{
        $validation['signin'] = 'blank';
        
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
    }
  </style>

  
</head>
<body>
  <h1>サインイン</h1>
  <form method="POST" action="">
    <div>
      メールアドレス<br>
      <input type="email" name="email" value="">
      <?php if (isset($validation['signin']) && $validation['signin'] == 'blank'): ?>
        <span class="error_msg">メールアドレスとパスワードは正しく入力してください</span>
      <?php endif; ?>
      <?php if (isset($validation['signin']) && $validation['signin'] == 'failed'): ?>
        <span class="error_msg">サインインに失敗しました</span>
      <?php endif; ?>
    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="">
    </div>

    <input type="submit" value="サインイン">
  </form>

</body>
</html>