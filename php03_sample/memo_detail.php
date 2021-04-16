<?php
// var_dump($_GET);
// exit();

// DB接続の設定
include('functions.php');
$id = $_GET['id'];
$pdo = connect_to_db();


$sql = 'SELECT * FROM memopad WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

// var_dump($record);
// exit();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <form action="memo_update.php" method="POST">
    <legend>詳細画面</legend>
    <fieldset>
        <div>
          タイトル：<input name="title" value="<?= $record['title']?>">
        </div>
        <div>
          詳細：<textarea name="detail" cols="50" rows="10"><?= $record['detail']?></textarea>
        </div>
        <div>
          <time>作成日時<?=$record["created_at"]?></time><br>
          <time>更新日時<?=$record["updated_at"]?></time>
        </div>
        <button>更新する</button>
      </fieldset>
      <input type="hidden" name="id" value="<?= $record['id']?>">
      </form>
      <a href="memo_read.php">一覧へ戻る</a>
      <a href="memo_delete.php?id=<?=$record['id']?>">削除する</a>


</body>

</html>
