<?php
//DB接続処理定型文↓
    $dsn = 'mysql:dbname=46_learnsns;host=localhost';
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //↑sql側のエラー表示させるためのコード
    $dbh->query('SET NAMES utf8');
?>