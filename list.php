<?php

$mysqli = new mysqli("localhost", "stucp2021db", "@r25stucp2021DBPW", "stucp2021db");
if ($mysqli->connect_error) {
    $error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
}else{
    // 文字化け防止
    $mysqli->set_charset("utf8");
    $sql="SELECT * FROM t305_kadai5";
    $res = $mysqli->query($sql);
    if( $res ) {
        $row = $res->fetch_all(MYSQLI_ASSOC);
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
<center>

<div class="hero is-info is-success">
   <div class="hero-body">
       <div class="container">
        <h1 class="title">健康管理アプリ</h1>
        <h2 class="subtitle">健康記録一覧</h2>
       </div>
   </div>
</div>

<div style="display:inline-flex">
  <form action="search_result.php" method="post">
    <div>
      <input type="text" name="search_name" size="20"></text>
    </div>
      <input type="submit" name="search_name_btn" value="名前から探す">
  </form>

  <form action="search_result.php" method="post">
    <div>
      <input type="date" name="search_date" size="20"></text>
    </div>
      <input type="submit" name="search_date_btn" value="日付から探す">
  </form>
</div>

<div style="text-align:center">

<section class="content">
<table border="1" width="30%" cellpadding="10" align="center">
<tr>
<th width="10%">ID</th><th width="15%">日付</th><th width="20%">名前</th><th width="10%">体温</th>
<th width="10%">健康状態</th><th width="20%">メモ</th>

<?php foreach( $row as $value ) { ?>
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
</section>

<a href="index.php">ホームへ</a>
</div>
</body>
</html>