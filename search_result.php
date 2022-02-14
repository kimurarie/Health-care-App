<?php

// データベースの接続情報
define( 'DB_HOST', 'localhost');
define( 'DB_USER', 'stucp2021db');
define( 'DB_PASS', '@r25stucp2021DBPW');
define( 'DB_NAME', 'stucp2021db');

$error_message = [];

if( !preg_replace("/( |　)/", "", $_POST['search_name'] ) )  {
    $error_message['name'] = '名前を入力してください。';
}else{
    $name=$_POST['search_name'];
}

if(!isset($_POST['search_date'])){
    $error_message['date']='日付を選択してください。';
}else{
    $date=$_POST['search_date'];
}

if(isset($error_message)){
    $error_message['search'] = '検索条件を入力してください。';
}

if( (!empty($_POST['search_name_btn'])) OR (!empty($_POST['search_date_btn'])) ){

    // データベースに接続
    $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // 接続エラーの確認
    if( $mysqli->connect_errno ){
        $error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
    } else {
        // 文字コード設定
        $mysqli->set_charset('utf8');
        if(!empty($_POST['search_name_btn'])){
            $sql = "SELECT * FROM t305_kadai5 WHERE name='$name'";
            $res = $mysqli->query($sql);
            if($res) {
                $row = $res->fetch_all(MYSQLI_ASSOC);
            }
        }if(!empty($_POST['search_date_btn'])){
            $sql = "SELECT * FROM t305_kadai5 WHERE date='$date'";
            $res = $mysqli->query($sql);
            if($res) {
                $row = $res->fetch_all(MYSQLI_ASSOC);
            }
        }
    // データベースの接続を閉じる
    $mysqli->close();
    }
}

?>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.css">
<title>課題5</title>
</head>

<body>

<div style="text-align:center">

<div class="hero is-info is-success">
   <div class="hero-body">
       <div class="container">
        <h1 class="title">健康管理アプリ</h1>

        <?php if( (isset($name))) : ?>
        <h2 class="subtitle">"<?php echo $name;?>"の検索結果</h2>
        <?php endif; ?>

        <?php if( (isset($date))) : ?>
        <h2 class="subtitle">"<?php echo $date;?>"の検索結果</h2>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php if( (isset($error_message)) AND (!isset($name)) AND (!isset($date))) : ?>
    <?php echo $error_message['search']; ?>
<?php endif; ?>

<?php if( (isset($name)) OR (isset($date))  ): ?>
<section class="content">
<table border="1" width="50%" cellpadding="10" align="center">
<tr>
<th width="10%">ID</th><th width="15%">日付</th><th width="20%">名前</th><th width="10%">体温</th>
<th width="10%">健康状態</th><th width="20%">メモ</th>
<?php endif; ?>

<?php foreach((array)$row as $value ) { ?>
    <div>
       <tr><td><?php echo $value['id']; ?></td>
           <td><?php echo $value['date']; ?></td>
           <td><?php echo $value['name']; ?></td>
           <td><?php echo $value['bt']; ?></td>
           <td><?php echo $value['health']; ?></td>
           <td><?php echo $value['memo']; ?></td>
       </tr>
    </div>
<?php }
?>
</table>

<a href="index.php">ホームへ</a>
<a href="list.php">記録一覧</a>

</body>
</html>