<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.css">
<title>課題5</title>
</head>

<body>
<center>

<div class="hero is-info is-success">
   <div class="hero-body">
       <div class="container">
        <h1 class="title">健康管理アプリ</h1>
       </div>
    </div>
</div>

<form action="register.php" method="post">
  <div class="content">
    <label for="name">名前：</label>
    <input type="text"  id="name" name="name" size="20"></text>
  </div>
  <div class="content">
    <label for="date">日付：</label>
    <input type="date" id="date" name="date" size="20"></text>
  </div>
  <div class="content">
    <label for="bt">体温：</label>
    <input type="text" id="bt" name="bt" size="20"></text>
  </div>
  <div class="health content">健康状態：
  <input type="radio" name="health" value="良好">良好
    <input type="radio" name="health" value="普通">普通
    <input type="radio" name="health" value="不調">不調
  </div>
  <div class="content">
  <textarea name="memo" rows="4" cols="40">行動記録など</textarea>
  </div>
  <div>
  <input type="submit" class="button is-success" name="btn" value="送信">
  <input type="reset" class="button is-success"  value="リセット">
  </div>

<a href="list.php">健康記録一覧</a><br>
<a href="健康管理アプリ使い方.pdf">使い方</a><br>
<a href="https://bulma.io/">使用しているCSSフレームワーク(Bulma)</a><br>

</center>
</body>
</html>