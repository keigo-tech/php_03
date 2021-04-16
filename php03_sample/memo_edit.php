<?php
var_dump($_GET);
exit();

// DB接続の設定
include('functions.php');
$id = $_GET['id'];
$pdo = connect_to_db();


$sql = 'SELECT * FROM memopad WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
  var_dump($result);
  exit();
}


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
      <legend>メモパッド</legend>
      <a href="memo_read.php">一覧画面</a>
      <div>
        タイトル: <input type="text" name="title" value="<?=$record['title']?>">
      </div>
      <div>
        詳細: <textarea name="detail" rows="10" cols="50"><?=$record['detail']?></textarea>
      </div>
      <div>
        <button>更新する</button>
      </div>
  </form>

</body>

</html>
