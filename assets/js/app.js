$(function() {
  //いいね処理
    $('.js-like').on('click', function() {
      //user_id,feed_id取得できてるか確認
      //$(this)今のイベントを発動させた部品
      var feed_id = $(this).siblings('.feed-id').text();
      var user_id = $('#signin_user').text();

      var like_btn = $(this); //たくさんあるいいね！ボタンのうち、押されたボタンそのもの
      var like_count = $(this).siblings('.like_count').text();//

      console.log(feed_id);
      console.log(user_id);


//やりたい処理↓(ajaxで動作させたい処理を記述)
        $.ajax({
          //送信、送信するデータなどを記述（目的の処理）
          url:'like.php',//実行したいプログラム
          type:'POST',//送信方法
          datatype: 'json',//受信されてくるデータの形式
          data:{
            'feed_id':feed_id,
            'user_id':user_id,
            'is_liked':true//いいねボタンを押した直後
          }
        })
        .done(function(data){
          //目的の処理が成功した時の処理
          console.log(data);
          if (data == 'true'){
            like_count++; //like_cout+1と同じ意味
            like_btn.siblings('.like_count').text(like_count); //いいね！を押したらいいね数の数値が増える
          }
        })
        .fail(function(err){
          //目的の処理が失敗した時の処理
          console.log('error')
        })

    });
    //いいねを取り消す処理
    $('.js-unlike').on('click', function() {
      var feed_id = $(this).siblings('.feed-id').text();
      var user_id = $('#signin_user').text();

      var like_btn = $(this); //たくさんあるいいね！ボタンのうち、押されたボタンそのもの
      var like_count = $(this).siblings('.like_count').text();//

      console.log(feed_id);
      console.log(user_id);

      $.ajax({
          //送信、送信するデータなどを記述（目的の処理）
          url:'like.php',//実行したいプログラム
          type:'POST',//送信方法
          datatype: 'json',//受信されてくるデータの形式
          data:{
            'feed_id':feed_id,
            'user_id':user_id
          }
        })
        .done(function(data){
          //目的の処理が成功した時の処理
          console.log(data);
          if (data == 'true'){
            like_count--; //like_cout-1と同じ意味
            like_btn.siblings('.like_count').text(like_count); //いいねを取り消すボタンを押したらいいね数の数値が減る
          }
        })
        .fail(function(err){
          //目的の処理が失敗した時の処理
          console.log('error')
        })


    })

});
