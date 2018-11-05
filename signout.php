<?php
    session_start();
//SESSION変数の中身を破棄
    $_SESSION = [];

//サーバー内の$_SESSION変数のクリア=引き出しそのものも消す
    session_destroy();

//signin.phpへの移動
    header("Location:signin.php");
    exit();//これ以上の処理を行わない


?>