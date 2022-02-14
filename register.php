<?php

// データベースの接続情報
define( 'DB_HOST', 'localhost');
define( 'DB_USER', 'stucp2021db');
define( 'DB_PASS', '@r25stucp2021DBPW');
define( 'DB_NAME', 'stucp2021db');

if(isset($_POST['name'])){
  $name=$_POST['name'];
}
if(isset($_POST['date'])){
  $date=$_POST['date'];
}
if(isset($_POST['bt'])){
  $bt=$_POST['bt'];
}
if(isset($_POST['health'])){
  $health=$_POST['health'];
}

if( !empty($_POST['btn']) ) {

    // 名前の入力チェック
    if( !preg_replace("/( |　)/", "", $name ) ) {
        $error_message['name'] = '名前を入力してください。';
    } else {
        $clean['name'] = htmlspecialchars( $name, ENT_QUOTES);
    }
    // 日付の入力チェック
    if( !preg_replace("/( |　)/", "", $date ) ) {
        $error_message['date'] = '日付を入力してください。';
    } else {
        $clean['date'] = htmlspecialchars( $date, ENT_QUOTES);
    }
    // 体温の入力チェック
    if( !preg_replace("/( |　)/", "", $bt )) {
        $error_message['bt'] = '体温を入力してください。';
    } else {
        $clean['bt'] = htmlspecialchars( $bt, ENT_QUOTES);
    }
    // 健康状態の入力チェック
    if( empty($health) ) {
        $error_message['health'] = '健康状態を１つ選択してください。';
    } else {
        $clean['health'] = htmlspecialchars( $health, ENT_QUOTES);
    }
    // メモの入力チェック
    if(isset($_POST['memo'])){
        $memo=$_POST['memo'];
        $clean['memo'] = htmlspecialchars( $memo, ENT_QUOTES);
    }

    if( empty($error_message) ) {
        // データベースに接続
        $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 接続エラーの確認
        if( $mysqli->connect_errno ) {
            $error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
        } else {

            // 文字コード設定
            $mysqli->set_charset('utf8');

            // データを登録するSQL作成
            $sql="INSERT INTO t305_kadai5 (name,date,bt,health,memo) VALUES
            ( '$clean[name]','$clean[date]','$clean[bt]','$clean[health]','$clean[memo]')";

            // データを登録
            $res=$mysqli->query($sql);
        }

    }

}

?>

<html>
<head>
<meta charset="utf-8">
<title>課題5</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.css">
</head>

<body>

<center>

<?php if( !empty($error_message) ): ?>
    <ul>
        <?php foreach( $error_message as $value ): ?>
                <li><?php echo $value; ?></li>
                    <?php endforeach; ?>
    </ul>
<a href="index.php">入力画面に戻る</a>
<?php endif; ?>

<?php if( empty($error_message) ): ?>
    <?php print("以下の内容を登録しました。<br>"); ?>
    <?php print("名前：$name<br>"); ?>
    <?php print ("日付：$date<br>"); ?>
    <?php print ("体温：$bt<br>"); ?>
    <?php print ("健康状態：$health<br>"); ?>
    <?php print ("メモ：$memo<br>"); ?>
<a href="index.php">ホームに戻る</a>
<?php endif; ?>

</center>
</body>
</html>