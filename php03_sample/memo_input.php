<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>DB連携型todoリスト（入力画面）</title>
</head>

<body>
  <form action="memo_create.php" method="POST">
    <fieldset>
      <legend>メモパッド</legend>
      <a href="memo_read.php">一覧に戻る</a>
      <div class="title">
        タイトル: <input type="text" name="title">
      </div>
      <div class="detail">
        <p>詳細: </p> <textarea name="detail" rows="10" cols="50"></textarea>
      </div>
      <div>
        <button>登録する</button>
      </div>
    </fieldset>
  </form>

</body>

</html>
