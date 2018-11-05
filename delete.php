<?php
//DBに接続
    require('dbconnect.php');
    require('function.php');
    
//http://localhost/LearnSNS/delete.php?feed_id=10というURLでここのファイルｎアクセスすると、？以降のfeed_idがGET送信されてくる
//$_GET["feed_id"]には10が格納されている
    v($_GET['feed_id'],"feed_id");

//消去したいFeedのIDを取得
    $feed_id = $_GET['feed_id'];


//Delete文作成
    $sql = "DELETE FROM `feeds` WHERE `feeds`.`id`=?";
    

    
//Delete文実行(SQLインジェクションを防ぐ)
    $data = array($feed_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);


//タイムライン一覧に戻る
    header("Location: timeline.php");
    exit();

  ?>